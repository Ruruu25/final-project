<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    private function guardAdmin(): void
    {
        abort_unless(StoreController::userIsAdmin(), 403, 'Only the administrator can manage store records.');
    }

    public function productsPage()
    {
        $this->guardAdmin();
        return view('admin.products', ['categories' => DB::table('categories')->orderBy('name')->get()]);
    }

    public function productsData()
    {
        $this->guardAdmin();
        return response()->json(['data' => DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.*', 'categories.name as category_name')
            ->orderByDesc('products.id')
            ->get()]);
    }

    public function storeProduct(Request $request)
    {
        $this->guardAdmin();
        $data = $this->validateProduct($request)->validated();
        $data['created_at'] = now();
        $data['updated_at'] = now();
        DB::table('products')->insert($data);
        return response()->json(['message' => 'Product saved.']);
    }

    public function updateProduct(Request $request, int $id)
    {
        $this->guardAdmin();
        $data = $this->validateProduct($request)->validated();
        $data['updated_at'] = now();
        DB::table('products')->where('id', $id)->update($data);
        return response()->json(['message' => 'Product updated.']);
    }

    public function destroyProduct(int $id)
    {
        $this->guardAdmin();
        DB::table('products')->where('id', $id)->delete();
        return response()->json(['message' => 'Product deleted.']);
    }

    public function categoriesPage()
    {
        $this->guardAdmin();
        return view('admin.categories');
    }

    public function categoriesData()
    {
        $this->guardAdmin();
        return response()->json(['data' => DB::table('categories')->orderByDesc('id')->get()]);
    }

    public function storeCategory(Request $request)
    {
        $this->guardAdmin();
        $data = $request->validate(['name' => ['required', 'string', 'max:100', 'unique:categories,name']]);
        $data['created_at'] = now();
        $data['updated_at'] = now();
        DB::table('categories')->insert($data);
        return response()->json(['message' => 'Category saved.']);
    }

    public function updateCategory(Request $request, int $id)
    {
        $this->guardAdmin();
        $data = $request->validate(['name' => ['required', 'string', 'max:100', Rule::unique('categories', 'name')->ignore($id)]]);
        $data['updated_at'] = now();
        DB::table('categories')->where('id', $id)->update($data);
        return response()->json(['message' => 'Category updated.']);
    }

    public function destroyCategory(int $id)
    {
        $this->guardAdmin();
        DB::table('categories')->where('id', $id)->delete();
        return response()->json(['message' => 'Category deleted.']);
    }

    public function customersPage()
    {
        $this->guardAdmin();
        return view('admin.customers');
    }

    public function customersData()
    {
        $this->guardAdmin();
        return response()->json(['data' => DB::table('customers')->orderByDesc('id')->get()]);
    }

    public function storeCustomer(Request $request)
    {
        $this->guardAdmin();
        $data = $this->validateCustomer($request)->validated();
        $data['created_at'] = now();
        $data['updated_at'] = now();
        DB::table('customers')->insert($data);
        return response()->json(['message' => 'Customer saved.']);
    }

    public function updateCustomer(Request $request, int $id)
    {
        $this->guardAdmin();
        $data = $this->validateCustomer($request, $id)->validated();
        $data['updated_at'] = now();
        DB::table('customers')->where('id', $id)->update($data);
        return response()->json(['message' => 'Customer updated.']);
    }

    public function destroyCustomer(int $id)
    {
        $this->guardAdmin();
        DB::table('customers')->where('id', $id)->delete();
        return response()->json(['message' => 'Customer deleted.']);
    }

    public function ordersPage()
    {
        $this->guardAdmin();
        return view('admin.orders', ['customers' => DB::table('customers')->orderBy('full_name')->get()]);
    }

    public function ordersData()
    {
        $this->guardAdmin();
        return response()->json(['data' => DB::table('orders')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->leftJoin('order_items', 'order_items.order_id', '=', 'orders.id')
            ->select('orders.*', 'customers.full_name', DB::raw('COALESCE(SUM(order_items.quantity), 0) as item_count'))
            ->groupBy('orders.id', 'orders.customer_id', 'orders.order_date', 'orders.status', 'orders.total_amount', 'orders.delivery_days', 'orders.received_at', 'orders.created_at', 'orders.updated_at', 'customers.full_name')
            ->orderByDesc('orders.id')
            ->get()
            ->map(function ($order) {
                $order->received_status = $order->status === 'Delivered' ? 'Received' : 'Not received yet';
                return $order;
            })]);
    }

    public function storeOrder(Request $request)
    {
        $this->guardAdmin();
        $data = $this->validateOrder($request)->validated();
        $data['order_date'] = now();
        $data['received_at'] = $data['status'] === 'Delivered' ? now() : null;
        $data['created_at'] = now();
        $data['updated_at'] = now();
        DB::table('orders')->insert($data);
        return response()->json(['message' => 'Order saved.']);
    }

    public function updateOrder(Request $request, int $id)
    {
        $this->guardAdmin();
        $data = $this->validateOrder($request)->validated();
        $current = DB::table('orders')->where('id', $id)->first();
        $data['received_at'] = $data['status'] === 'Delivered' ? ($current->received_at ?? now()) : null;
        $data['updated_at'] = now();
        DB::table('orders')->where('id', $id)->update($data);
        return response()->json(['message' => 'Order updated.']);
    }

    public function destroyOrder(int $id)
    {
        $this->guardAdmin();
        DB::table('orders')->where('id', $id)->delete();
        return response()->json(['message' => 'Order deleted.']);
    }

    private function validateProduct(Request $request)
    {
        return Validator::make($request->all(), [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'product_name' => ['required', 'string', 'max:150'],
            'brand' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
            'volume_ml' => ['required', 'integer', 'min:1'],
            'alcohol_content' => ['required', 'numeric', 'min:0', 'max:99.99'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'string', 'max:255'],
        ]);
    }

    private function validateCustomer(Request $request, ?int $id = null)
    {
        return Validator::make($request->all(), [
            'full_name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150', Rule::unique('customers', 'email')->ignore($id)],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:500'],
        ]);
    }

    private function validateOrder(Request $request)
    {
        return Validator::make($request->all(), [
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'status' => ['required', Rule::in(['Pending', 'Paid', 'Cancelled', 'Delivered'])],
            'total_amount' => ['required', 'numeric', 'min:0'],
            'delivery_days' => ['required', 'integer', 'min:1', 'max:14'],
        ]);
    }
}
