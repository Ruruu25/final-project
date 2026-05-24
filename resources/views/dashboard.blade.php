<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-amber-700">Liquor Drinks</p>
                <h2 class="text-2xl font-bold text-stone-950">{{ $isAdmin ? 'Admin Dashboard' : 'Customer Dashboard' }}</h2>
            </div>
            <a href="{{ route('store.home') }}" class="inline-flex items-center justify-center rounded-md bg-stone-950 px-4 py-2 text-sm font-semibold text-white">Open Shop</a>
        </div>
    </x-slot>

    <div class="bg-stone-50 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if ($isAdmin)
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ([['Total Orders', $stats['orders'] ?? 0], ['Pending Orders', $stats['pendingOrders'] ?? 0], ['Received Orders', $stats['receivedOrders'] ?? 0], ['Total Stock', $stats['totalStock'] ?? 0]] as [$label, $value])
                        <div class="rounded-lg border border-stone-200 bg-white p-5 shadow-sm">
                            <p class="text-sm text-stone-500">{{ $label }}</p>
                            <p class="mt-2 text-3xl font-bold text-stone-950">{{ $value }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5 grid gap-4 lg:grid-cols-3">
                    <div class="rounded-lg border border-stone-200 bg-white p-5 shadow-sm">
                        <p class="text-sm text-stone-500">Paid / received revenue</p>
                        <p class="mt-2 text-3xl font-bold text-emerald-700">PHP {{ number_format($stats['revenue'] ?? 0, 2) }}</p>
                    </div>
                    <div class="rounded-lg border border-stone-200 bg-white p-5 shadow-sm">
                        <p class="text-sm text-stone-500">Low stock products</p>
                        <p class="mt-2 text-3xl font-bold text-rose-700">{{ $stats['lowStock'] ?? 0 }}</p>
                    </div>
                    <div class="rounded-lg border border-stone-200 bg-white p-5 shadow-sm">
                        <p class="text-sm text-stone-500">Products listed</p>
                        <p class="mt-2 text-3xl font-bold text-stone-950">{{ $stats['products'] ?? 0 }}</p>
                    </div>
                </div>

                <div class="mt-5 grid gap-3 sm:grid-cols-4">
                    <a class="rounded-md bg-amber-700 px-4 py-3 text-center text-sm font-semibold text-white" href="{{ route('admin.orders') }}">Manage Orders</a>
                    <a class="rounded-md bg-stone-900 px-4 py-3 text-center text-sm font-semibold text-white" href="{{ route('admin.products') }}">Manage Products</a>
                    <a class="rounded-md bg-stone-900 px-4 py-3 text-center text-sm font-semibold text-white" href="{{ route('admin.customers') }}">Customers</a>
                    <a class="rounded-md bg-stone-900 px-4 py-3 text-center text-sm font-semibold text-white" href="{{ route('admin.categories') }}">Categories</a>
                </div>

                <div class="mt-6 grid gap-5 xl:grid-cols-[1.4fr_.9fr]">
                    <section class="rounded-lg border border-stone-200 bg-white p-5 shadow-sm">
                        <div class="flex flex-col gap-1 sm:flex-row sm:items-end sm:justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-stone-950">Recent Customer Orders</h3>
                                <p class="text-sm text-stone-500">See who ordered, delivery status, and how many days before receiving.</p>
                            </div>
                        </div>
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full text-left text-sm">
                                <thead class="border-b border-stone-200 text-xs uppercase tracking-wide text-stone-500">
                                    <tr>
                                        <th class="py-3 pr-4">Customer</th>
                                        <th class="py-3 pr-4">Status</th>
                                        <th class="py-3 pr-4">Received?</th>
                                        <th class="py-3 pr-4">Items</th>
                                        <th class="py-3 pr-4">Receive Date</th>
                                        <th class="py-3 pr-4">Days Left</th>
                                        <th class="py-3 pr-4">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-stone-100">
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td class="py-3 pr-4">
                                                <p class="font-bold text-stone-950">{{ $order->full_name }}</p>
                                                <p class="text-xs text-stone-500">#{{ $order->id }} {{ $order->phone }}</p>
                                            </td>
                                            <td class="py-3 pr-4">
                                                <span class="rounded-md px-2 py-1 text-xs font-bold {{ $order->status === 'Delivered' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                                    {{ $order->status === 'Delivered' ? 'Received / Delivered' : $order->status }}
                                                </span>
                                            </td>
                                            <td class="py-3 pr-4 font-semibold text-stone-700">{{ $order->received_label }}</td>
                                            <td class="py-3 pr-4">{{ $order->item_count }}</td>
                                            <td class="py-3 pr-4">{{ $order->expected_receive_date }}</td>
                                            <td class="py-3 pr-4 font-bold text-amber-700">{{ $order->status === 'Delivered' ? 'Done' : $order->remaining_days . ' day(s)' }}</td>
                                            <td class="py-3 pr-4 font-bold">PHP {{ number_format($order->total_amount, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="7" class="py-6 text-center text-stone-500">No orders yet.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <section class="rounded-lg border border-stone-200 bg-white p-5 shadow-sm">
                        <h3 class="text-lg font-bold text-stone-950">Stock Watch</h3>
                        <p class="text-sm text-stone-500">Lowest stock products first.</p>
                        <div class="mt-4 space-y-3">
                            @forelse ($stockProducts as $product)
                                <div class="rounded-md bg-stone-50 px-4 py-3">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <p class="font-bold text-stone-950">{{ $product->product_name }}</p>
                                            <p class="text-sm text-stone-500">{{ $product->category_name }} - {{ $product->brand }}</p>
                                        </div>
                                        <p class="text-lg font-black {{ $product->stock <= 25 ? 'text-rose-700' : 'text-emerald-700' }}">{{ $product->stock }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-stone-500">No stock records yet.</p>
                            @endforelse
                        </div>
                    </section>
                </div>
            @else
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ([['My Orders', $stats['orders'] ?? 0], ['Pending', $stats['pendingOrders'] ?? 0], ['Received', $stats['receivedOrders'] ?? 0], ['Paid Total', 'PHP ' . number_format($stats['totalSpent'] ?? 0, 2)]] as [$label, $value])
                        <div class="rounded-lg border border-stone-200 bg-white p-5 shadow-sm">
                            <p class="text-sm text-stone-500">{{ $label }}</p>
                            <p class="mt-2 text-3xl font-bold text-stone-950">{{ $value }}</p>
                        </div>
                    @endforeach
                </div>

                <section class="mt-6 rounded-lg border border-stone-200 bg-white p-5 shadow-sm">
                    <h3 class="text-lg font-bold text-stone-950">My Order Receiving Status</h3>
                    <p class="text-sm text-stone-500">Track whether your order is already received and how many days it may take.</p>
                    <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full text-left text-sm">
                            <thead class="border-b border-stone-200 text-xs uppercase tracking-wide text-stone-500">
                                <tr>
                                    <th class="py-3 pr-4">Order</th>
                                    <th class="py-3 pr-4">Status</th>
                                    <th class="py-3 pr-4">Received?</th>
                                    <th class="py-3 pr-4">Items</th>
                                    <th class="py-3 pr-4">Can Be Received</th>
                                    <th class="py-3 pr-4">Days Left</th>
                                    <th class="py-3 pr-4">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-100">
                                @forelse ($customerOrders as $order)
                                    <tr>
                                        <td class="py-3 pr-4">
                                            <p class="font-bold text-stone-950">Order #{{ $order->id }}</p>
                                            <p class="text-xs text-stone-500">{{ $order->order_date }}</p>
                                        </td>
                                        <td class="py-3 pr-4">{{ $order->status === 'Delivered' ? 'Received / Delivered' : $order->status }}</td>
                                        <td class="py-3 pr-4 font-semibold text-stone-700">{{ $order->received_label }}</td>
                                        <td class="py-3 pr-4">{{ $order->item_count }}</td>
                                        <td class="py-3 pr-4">{{ $order->expected_receive_date }} <span class="text-xs text-stone-500">({{ $order->delivery_days }} day estimate)</span></td>
                                        <td class="py-3 pr-4 font-bold text-amber-700">{{ $order->status === 'Delivered' ? 'Done' : $order->remaining_days . ' day(s)' }}</td>
                                        <td class="py-3 pr-4 font-bold">PHP {{ number_format($order->total_amount, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7" class="py-6 text-center text-stone-500">You do not have orders yet. Place an order from the shop to see it here.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            @endif
        </div>
    </div>
</x-app-layout>
