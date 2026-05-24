<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    public function home()
    {
        if (! Schema::hasTable('categories') || ! Schema::hasTable('products')) {
            return view('welcome', ['categories' => collect(), 'featured' => collect()]);
        }

        $categories = DB::table('categories')->orderBy('name')->get();
        $featured = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.*', 'categories.name as category_name')
            ->orderByDesc('stock')
            ->limit(8)
            ->get();

        return view('welcome', compact('categories', 'featured'));
    }

    public function products(Request $request)
    {
        if (! Schema::hasTable('categories') || ! Schema::hasTable('products')) {
            return response()->json([]);
        }

        $query = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.*', 'categories.name as category_name');

        if ($request->filled('category_id')) {
            $query->where('products.category_id', $request->integer('category_id'));
        }

        if ($request->filled('search')) {
            $term = '%' . $request->string('search')->toString() . '%';
            $query->where(function ($q) use ($term) {
                $q->where('product_name', 'like', $term)
                    ->orWhere('brand', 'like', $term)
                    ->orWhere('categories.name', 'like', $term);
            });
        }

        return response()->json($query->orderBy('product_name')->get());
    }

    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:500'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['required', 'integer', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1', 'max:50'],
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Please check the checkout form.', 'errors' => $validator->errors()], 422);
        }

        $payload = $validator->validated();

        return DB::transaction(function () use ($payload) {
            $customer = DB::table('customers')->where('email', $payload['email'])->first();
            $customerData = [
                'full_name' => $payload['full_name'],
                'email' => $payload['email'],
                'phone' => $payload['phone'],
                'address' => $payload['address'],
                'updated_at' => now(),
            ];

            if ($customer) {
                DB::table('customers')->where('id', $customer->id)->update($customerData);
                $customerId = $customer->id;
            } else {
                $customerData['created_at'] = now();
                $customerId = DB::table('customers')->insertGetId($customerData);
            }

            $total = 0;
            $items = [];
            foreach ($payload['items'] as $line) {
                $product = DB::table('products')->lockForUpdate()->where('id', $line['id'])->first();
                if (!$product || $product->stock < $line['quantity']) {
                    return response()->json(['message' => 'Some selected items are no longer available.'], 422);
                }

                $subtotal = $product->price * $line['quantity'];
                $total += $subtotal;
                $items[] = [$product, $line['quantity'], $subtotal];
            }

            $orderData = [
                'customer_id' => $customerId,
                'order_date' => now(),
                'status' => 'Pending',
                'total_amount' => $total,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (Schema::hasColumn('orders', 'delivery_days')) {
                $orderData['delivery_days'] = 3;
            }

            $orderId = DB::table('orders')->insertGetId($orderData);

            foreach ($items as [$product, $quantity, $subtotal]) {
                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('products')->where('id', $product->id)->decrement('stock', $quantity, ['updated_at' => now()]);
            }

            return response()->json(['message' => 'Order placed successfully. Estimated receiving time is 3 days.', 'order_id' => $orderId, 'delivery_days' => 3]);
        });
    }

    public static function userIsAdmin(): bool
    {
        $user = auth()->user();
        if (!$user) {
            return false;
        }

        if (Schema::hasColumn('users', 'role') && ($user->role ?? null) === 'admin') {
            return true;
        }

        return $user->email === 'rbantiles52@gmail.com';
    }
}
