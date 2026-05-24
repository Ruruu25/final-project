<x-app-layout>
<x-slot name="header">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm font-bold uppercase tracking-wide text-amber-700">Admin</p>
            <h2 class="text-2xl font-black text-stone-950">Orders and Receiving</h2>
        </div>
        <button id="addRecord" class="rounded-md bg-amber-700 px-4 py-2 text-sm font-bold text-white">Add Order</button>
    </div>
</x-slot>
<div class="bg-stone-50 py-8">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="rounded-lg border bg-white p-5 shadow-sm">
            <table id="recordsTable" class="display w-full">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Received?</th>
                        <th>Items</th>
                        <th>Delivery Days</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div id="recordModal" class="fixed inset-0 z-50 hidden bg-black/40 p-4">
    <div class="mx-auto mt-12 max-w-lg rounded-lg bg-white p-5 shadow-xl">
        <div class="mb-4 flex items-center justify-between">
            <h3 id="modalTitle" class="text-xl font-black"></h3>
            <button id="closeModal" class="rounded-md bg-stone-100 px-3 py-2 text-sm font-bold">Close</button>
        </div>
        <form id="recordForm" class="grid gap-3">
            <input type="hidden" name="id">
            <select name="customer_id" required class="rounded-md border-stone-300">
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->full_name }}</option>
                @endforeach
            </select>
            <select name="status" required class="rounded-md border-stone-300">
                <option value="Pending">Pending</option>
                <option value="Paid">Paid</option>
                <option value="Cancelled">Cancelled</option>
                <option value="Delivered">Received / Delivered</option>
            </select>
            <input name="delivery_days" required type="number" min="1" max="14" placeholder="Days until received" class="rounded-md border-stone-300">
            <input name="total_amount" required type="number" min="0" step="0.01" placeholder="Total amount" class="rounded-md border-stone-300">
            <button class="rounded-md bg-amber-700 px-4 py-2 text-sm font-bold text-white">Save Order</button>
            <p id="formMessage" class="text-sm font-bold"></p>
        </form>
    </div>
</div>
@include('admin._datatable')
<script>
adminCrud({
    dataUrl: @json(route('admin.orders.data')),
    baseUrl: @json(route('admin.orders.store')),
    fields: ['customer_id','status','delivery_days','total_amount'],
    columns: [
        {data:'id'},
        {data:'full_name'},
        {data:'order_date'},
        {data:'status', render:data => data === 'Delivered' ? 'Received / Delivered' : data},
        {data:'received_status'},
        {data:'item_count'},
        {data:'delivery_days', render:data => `${data || 3} day(s)`},
        {data:'total_amount', render:data=>'PHP '+Number(data).toFixed(2)},
        {data:null, orderable:false, render:data=>actionButtons(data)}
    ]
});
</script>
</x-app-layout>
