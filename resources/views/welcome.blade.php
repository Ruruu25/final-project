<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Liquor Drinks Online Store</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-stone-50 text-stone-950 antialiased">
    <header class="sticky top-0 z-40 border-b border-stone-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('store.home') }}" class="flex items-center gap-3">
                <span class="grid h-10 w-10 place-items-center rounded-md bg-amber-700 text-lg font-black text-white">LD</span>
                <span>
                    <span class="block text-base font-extrabold leading-tight">Liquor Drinks</span>
                    <span class="block text-xs font-semibold uppercase tracking-wide text-stone-500">Online Store</span>
                </span>
            </a>
            <nav class="flex items-center gap-2 text-sm font-semibold">
                @auth
                    <a class="rounded-md px-3 py-2 text-stone-700 hover:bg-stone-100" href="{{ route('dashboard') }}">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">@csrf<button class="rounded-md px-3 py-2 text-stone-700 hover:bg-stone-100">Logout</button></form>
                @else
                    <a class="rounded-md px-3 py-2 text-stone-700 hover:bg-stone-100" href="{{ route('login') }}">Login</a>
                    <a class="rounded-md bg-stone-950 px-4 py-2 text-white" href="{{ route('register') }}">Register</a>
                @endauth
                <button id="cartButton" class="rounded-md bg-amber-700 px-4 py-2 text-white">Cart <span id="cartCount">0</span></button>
            </nav>
        </div>
    </header>

    <main>
        <section class="store-hero">
            <div class="mx-auto grid max-w-7xl gap-8 px-4 py-12 sm:px-6 lg:grid-cols-[1.05fr_.95fr] lg:px-8">
                <div class="self-center py-6">
                    <p class="text-sm font-bold uppercase tracking-wide text-amber-700">Premium local and imported selections</p>
                    <h1 class="mt-3 max-w-3xl text-4xl font-black leading-tight text-stone-950 sm:text-6xl">Liquor Drinks Online Store</h1>
                    <p class="mt-5 max-w-2xl text-lg leading-8 text-stone-700">Browse beers, gin, rum, brandy, whiskey, vodka, wine, tequila, and liqueurs from the liquor store database. Add items to cart and place orders through an AJAX checkout.</p>
                    <div class="mt-7 flex flex-wrap gap-3">
                        <a href="#catalog" class="rounded-md bg-stone-950 px-5 py-3 text-sm font-bold text-white">Shop Products</a>
                        @auth<a href="{{ route('dashboard') }}" class="rounded-md border border-stone-300 bg-white px-5 py-3 text-sm font-bold text-stone-900">View Dashboard</a>@endauth
                    </div>
                </div>
                <div class="hero-shelf" aria-hidden="true">
                    <div class="bottle bottle-one"></div>
                    <div class="bottle bottle-two"></div>
                    <div class="bottle bottle-three"></div>
                    <div class="shelf-card">
                        <span class="text-sm font-bold uppercase tracking-wide text-stone-500">Today in stock</span>
                        <strong>{{ $featured->sum('stock') }} bottles</strong>
                        <span>{{ $categories->count() }} categories ready for checkout</span>
                    </div>
                </div>
            </div>
        </section>

        <section id="catalog" class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div>
                    <p class="text-sm font-bold uppercase tracking-wide text-amber-700">Catalog</p>
                    <h2 class="text-3xl font-black text-stone-950">Shop available drinks</h2>
                </div>
                <div class="grid gap-3 sm:grid-cols-[1fr_220px]">
                    <input id="searchInput" type="search" placeholder="Search product, brand, category" class="rounded-md border-stone-300 text-sm shadow-sm focus:border-amber-700 focus:ring-amber-700">
                    <select id="categoryFilter" class="rounded-md border-stone-300 text-sm shadow-sm focus:border-amber-700 focus:ring-amber-700">
                        <option value="">All categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="productGrid" class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-4"></div>
        </section>
    </main>

    <aside id="cartPanel" class="cart-panel" aria-hidden="true">
        <div class="flex items-center justify-between border-b border-stone-200 p-5">
            <h2 class="text-xl font-black">Your Cart</h2>
            <button id="closeCart" class="rounded-md bg-stone-100 px-3 py-2 text-sm font-bold">Close</button>
        </div>
        <div id="cartItems" class="max-h-[38vh] overflow-auto p-5"></div>
        <form id="checkoutForm" class="space-y-3 border-t border-stone-200 p-5">
            @csrf
            <div class="flex items-center justify-between text-lg font-black"><span>Total</span><span id="cartTotal">PHP 0.00</span></div>
            @auth
                <input name="full_name" required value="{{ auth()->user()->name }}" placeholder="Full name" class="w-full rounded-md border-stone-300 text-sm">
                <input name="email" required type="email" value="{{ auth()->user()->email }}" placeholder="Email" class="w-full rounded-md border-stone-300 text-sm">
                <input name="phone" required placeholder="Phone number" class="w-full rounded-md border-stone-300 text-sm">
                <textarea name="address" required placeholder="Delivery address" class="w-full rounded-md border-stone-300 text-sm"></textarea>
                <button class="w-full rounded-md bg-amber-700 px-4 py-3 text-sm font-bold text-white">Place Order</button>
            @else
                <a href="{{ route('login') }}" class="block rounded-md bg-stone-950 px-4 py-3 text-center text-sm font-bold text-white">Login to Checkout</a>
            @endauth
            <p id="checkoutMessage" class="text-sm font-semibold"></p>
        </form>
    </aside>

<script>
const productUrl = @json(route('store.products'));
const checkoutUrl = @json(route('store.checkout'));
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
let products = [];
let cart = JSON.parse(localStorage.getItem('liquorCart') || '[]');

const money = value => 'PHP ' + Number(value || 0).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
const saveCart = () => { localStorage.setItem('liquorCart', JSON.stringify(cart)); renderCart(); };

async function loadProducts() {
    const url = new URL(productUrl, window.location.origin);
    const search = document.getElementById('searchInput').value;
    const category = document.getElementById('categoryFilter').value;
    if (search) url.searchParams.set('search', search);
    if (category) url.searchParams.set('category_id', category);
    products = await fetch(url).then(response => response.json());
    renderProducts();
}

function renderProducts() {
    const grid = document.getElementById('productGrid');
    grid.innerHTML = products.map(product => `
        <article class="product-card">
            <div class="product-visual"><span>${product.category_name}</span><strong>${product.brand.slice(0, 2).toUpperCase()}</strong></div>
            <div class="p-4">
                <div class="flex items-start justify-between gap-3">
                    <div><h3 class="font-black text-stone-950">${product.product_name}</h3><p class="text-sm text-stone-500">${product.brand}</p></div>
                    <p class="font-black text-amber-700">${money(product.price)}</p>
                </div>
                <p class="mt-3 min-h-10 text-sm text-stone-600">${product.description || ''}</p>
                <div class="mt-4 flex flex-wrap gap-2 text-xs font-bold text-stone-600"><span>${product.volume_ml} ml</span><span>${product.alcohol_content}% ABV</span><span>${product.stock} stock</span></div>
                <button class="mt-4 w-full rounded-md bg-stone-950 px-4 py-2 text-sm font-bold text-white disabled:bg-stone-300" ${product.stock < 1 ? 'disabled' : ''} onclick="addToCart(${product.id})">Add to Cart</button>
            </div>
        </article>`).join('') || '<p class="col-span-full rounded-lg bg-white p-6 text-stone-600">No products found.</p>';
}

function addToCart(id) {
    const product = products.find(item => item.id === id);
    const existing = cart.find(item => item.id === id);
    if (existing) existing.quantity += 1;
    else cart.push({id: product.id, name: product.product_name, price: Number(product.price), quantity: 1});
    saveCart();
    document.getElementById('cartPanel').classList.add('open');
}

function renderCart() {
    const items = document.getElementById('cartItems');
    document.getElementById('cartCount').textContent = cart.reduce((sum, item) => sum + item.quantity, 0);
    document.getElementById('cartTotal').textContent = money(cart.reduce((sum, item) => sum + item.price * item.quantity, 0));
    items.innerHTML = cart.map(item => `
        <div class="mb-3 rounded-md bg-stone-50 p-3">
            <div class="flex items-start justify-between gap-3"><strong>${item.name}</strong><button class="text-sm font-bold text-rose-700" onclick="removeFromCart(${item.id})">Remove</button></div>
            <div class="mt-2 flex items-center justify-between text-sm"><span>${money(item.price)}</span><input class="w-20 rounded-md border-stone-300 text-sm" type="number" min="1" value="${item.quantity}" onchange="changeQty(${item.id}, this.value)"></div>
        </div>`).join('') || '<p class="text-sm text-stone-500">Your cart is empty.</p>';
}
function removeFromCart(id) { cart = cart.filter(item => item.id !== id); saveCart(); }
function changeQty(id, value) { const item = cart.find(row => row.id === id); item.quantity = Math.max(1, Number(value)); saveCart(); }

document.getElementById('cartButton').addEventListener('click', () => document.getElementById('cartPanel').classList.add('open'));
document.getElementById('closeCart').addEventListener('click', () => document.getElementById('cartPanel').classList.remove('open'));
document.getElementById('searchInput').addEventListener('input', loadProducts);
document.getElementById('categoryFilter').addEventListener('change', loadProducts);
const checkoutForm = document.getElementById('checkoutForm');
if (checkoutForm) checkoutForm.addEventListener('submit', async event => {
    event.preventDefault();
    const message = document.getElementById('checkoutMessage');
    message.textContent = 'Sending order...';
    const body = Object.fromEntries(new FormData(checkoutForm).entries());
    body.items = cart.map(({id, quantity}) => ({id, quantity}));
    const response = await fetch(checkoutUrl, {method: 'POST', headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json'}, body: JSON.stringify(body)});
    const data = await response.json();
    message.textContent = data.message || 'Checkout completed.';
    message.className = response.ok ? 'text-sm font-semibold text-emerald-700' : 'text-sm font-semibold text-rose-700';
    if (response.ok) { cart = []; saveCart(); checkoutForm.reset(); loadProducts(); }
});
renderCart();
loadProducts();
</script>
</body>
</html>
