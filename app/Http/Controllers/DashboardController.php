<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        if (! Schema::hasTable('products') || ! Schema::hasTable('orders')) {
            return view('dashboard', [
                'isAdmin'      => StoreController::userIsAdmin(),
                'stats'        => [],
                'orders'       => collect(),
                'stockProducts'=> collect(),
                'customerOrders'=> collect(),
                'chartData'    => [],
            ]);
        }

        return StoreController::userIsAdmin()
            ? $this->adminDashboard()
            : $this->customerDashboard();
    }

    private function adminDashboard()
    {
        $stats = [
            'products'      => DB::table('products')->count(),
            'orders'        => DB::table('orders')->count(),
            'pendingOrders' => DB::table('orders')->where('status', 'Pending')->count(),
            'receivedOrders'=> DB::table('orders')->where('status', 'Delivered')->count(),
            'revenue'       => DB::table('orders')->whereIn('status', ['Paid', 'Delivered'])->sum('total_amount'),
            'totalStock'    => DB::table('products')->sum('stock'),
            'lowStock'      => DB::table('products')->where('stock', '<=', 25)->count(),
        ];

        $orders = DB::table('orders')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->leftJoin('order_items', 'order_items.order_id', '=', 'orders.id')
            ->select(
                'orders.*',
                'customers.full_name',
                'customers.phone',
                'customers.address',
                DB::raw('COALESCE(SUM(order_items.quantity), 0) as item_count')
            )
            ->groupBy(
                'orders.id', 'orders.customer_id', 'orders.order_date',
                'orders.status', 'orders.total_amount', 'orders.delivery_days',
                'orders.received_at', 'orders.created_at', 'orders.updated_at',
                'customers.full_name', 'customers.phone', 'customers.address'
            )
            ->orderByDesc('orders.order_date')
            ->limit(12)
            ->get()
            ->map(fn ($order) => $this->withDeliveryDetails($order));

        $stockProducts = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.product_name', 'products.brand', 'products.stock', 'products.price', 'categories.name as category_name')
            ->orderBy('products.stock')
            ->limit(10)
            ->get();

        // Chart 1: orders by status (doughnut)
        $ordersByStatus = DB::table('orders')
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get()
            ->pluck('total', 'status');

        // Chart 2: stock by category (bar)
        $stockByCategory = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('categories.name', DB::raw('SUM(products.stock) as total_stock'))
            ->groupBy('categories.name')
            ->orderBy('categories.name')
            ->get();

        // Chart 3: revenue last 7 days (line)
        $revenueByDay = DB::table('orders')
            ->whereIn('status', ['Paid', 'Delivered'])
            ->where('order_date', '>=', now()->subDays(6)->startOfDay())
            ->select(
                DB::raw("DATE(order_date) as day"),
                DB::raw('SUM(total_amount) as revenue')
            )
            ->groupBy('day')
            ->orderBy('day')
            ->get()
            ->keyBy('day');

        // Fill in missing days with 0
        $days = collect();
        for ($i = 6; $i >= 0; $i--) {
            $d = now()->subDays($i)->format('Y-m-d');
            $days->push(['day' => $d, 'revenue' => $revenueByDay->get($d)?->revenue ?? 0]);
        }

        $chartData = [
            'ordersByStatus'  => $ordersByStatus,
            'stockByCategory' => $stockByCategory,
            'revenueByDay'    => $days,
        ];

        return view('dashboard', [
            'isAdmin'        => true,
            'stats'          => $stats,
            'orders'         => $orders,
            'stockProducts'  => $stockProducts,
            'customerOrders' => collect(),
            'chartData'      => $chartData,
        ]);
    }

    private function customerDashboard()
    {
        $user     = auth()->user();
        $customer = DB::table('customers')->where('email', $user->email)->first();
        $customerOrders = collect();

        if ($customer) {
            $customerOrders = DB::table('orders')
                ->leftJoin('order_items', 'order_items.order_id', '=', 'orders.id')
                ->select('orders.*', DB::raw('COALESCE(SUM(order_items.quantity), 0) as item_count'))
                ->where('orders.customer_id', $customer->id)
                ->groupBy(
                    'orders.id', 'orders.customer_id', 'orders.order_date',
                    'orders.status', 'orders.total_amount', 'orders.delivery_days',
                    'orders.received_at', 'orders.created_at', 'orders.updated_at'
                )
                ->orderByDesc('orders.order_date')
                ->get()
                ->map(fn ($order) => $this->withDeliveryDetails($order));
        }

        $stats = [
            'orders'        => $customerOrders->count(),
            'pendingOrders' => $customerOrders->where('status', 'Pending')->count(),
            'receivedOrders'=> $customerOrders->where('status', 'Delivered')->count(),
            'totalSpent'    => $customerOrders->whereIn('status', ['Paid', 'Delivered'])->sum('total_amount'),
        ];

        return view('dashboard', [
            'isAdmin'        => false,
            'stats'          => $stats,
            'orders'         => collect(),
            'stockProducts'  => collect(),
            'customerOrders' => $customerOrders,
            'chartData'      => [],
        ]);
    }

    private function withDeliveryDetails(object $order): object
    {
        $orderedAt    = $order->order_date ? Carbon::parse($order->order_date) : Carbon::parse($order->created_at ?? now());
        $deliveryDays = (int) ($order->delivery_days ?? 3);
        $expectedAt   = $orderedAt->copy()->addDays($deliveryDays);
        $remainingDays= now()->startOfDay()->diffInDays($expectedAt->copy()->startOfDay(), false);

        $order->delivery_days        = $deliveryDays;
        $order->expected_receive_date= $expectedAt->format('M d, Y');
        $order->remaining_days       = max(0, $remainingDays);
        $order->received_label       = $order->status === 'Delivered' ? 'Received' : 'Not received yet';

        return $order;
    }
}