<nav x-data="{ open: false }" class="border-b border-stone-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <div class="flex shrink-0 items-center">
                    <a href="{{ route('store.home') }}" class="flex items-center gap-3">
                        <span class="grid h-9 w-9 place-items-center rounded-md bg-amber-700 text-sm font-black text-white">LD</span>
                        <span class="font-black text-stone-950">Liquor Drinks</span>
                    </a>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-nav-link>
                    <x-nav-link :href="route('store.home')" :active="request()->routeIs('store.home')">{{ __('Shop') }}</x-nav-link>
                    @if (\App\Http\Controllers\StoreController::userIsAdmin())
                        <x-nav-link :href="route('admin.products')" :active="request()->routeIs('admin.products')">{{ __('Products') }}</x-nav-link>
                        <x-nav-link :href="route('admin.categories')" :active="request()->routeIs('admin.categories')">{{ __('Categories') }}</x-nav-link>
                        <x-nav-link :href="route('admin.customers')" :active="request()->routeIs('admin.customers')">{{ __('Customers') }}</x-nav-link>
                        <x-nav-link :href="route('admin.orders')" :active="request()->routeIs('admin.orders')">{{ __('Orders') }}</x-nav-link>
                    @endif
                </div>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-stone-600 transition hover:text-stone-900 focus:outline-none">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="inline-block px-4 py-2 text-sm font-semibold text-stone-800 rounded hover:bg-stone-100">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-block px-4 py-2 text-sm font-semibold text-white bg-amber-700 rounded hover:bg-amber-800">Register</a>
                    @endif
                    <a href="{{ route('admin.login') }}" class="inline-block px-4 py-2 text-sm font-semibold text-amber-700 rounded hover:text-white hover:bg-amber-700">Admin Login</a>
                @endauth
            </div>
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center rounded-md p-2 text-stone-500 hover:bg-stone-100 hover:text-stone-700 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="space-y-1 pb-3 pt-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('store.home')" :active="request()->routeIs('store.home')">{{ __('Shop') }}</x-responsive-nav-link>
            @if (\App\Http\Controllers\StoreController::userIsAdmin())
                <x-responsive-nav-link :href="route('admin.products')" :active="request()->routeIs('admin.products')">{{ __('Products') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.categories')" :active="request()->routeIs('admin.categories')">{{ __('Categories') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.customers')" :active="request()->routeIs('admin.customers')">{{ __('Customers') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.orders')" :active="request()->routeIs('admin.orders')">{{ __('Orders') }}</x-responsive-nav-link>
            @endif
        </div>
        <div class="border-t border-stone-200 pb-1 pt-4">
            @auth
                <div class="px-4">
                    <div class="text-base font-medium text-stone-800">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium text-stone-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">{{ __('Profile') }}</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <x-responsive-nav-link :href="route('login')">{{ __('Login') }}</x-responsive-nav-link>
                @if (Route::has('register'))
                    <x-responsive-nav-link :href="route('register')">{{ __('Register') }}</x-responsive-nav-link>
                @endif
                <x-responsive-nav-link :href="route('admin.login')" class="text-amber-700">{{ __('Admin Login') }}</x-responsive-nav-link>
            @endauth
        </div>
    </div>
</nav>

TEST NAV