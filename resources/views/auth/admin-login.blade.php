<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login — Liquor Drinks</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-stone-100 font-[Figtree] antialiased">

    <div class="flex min-h-screen items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">

            {{-- Card --}}
            <div class="rounded-2xl border border-stone-200 bg-white p-8 shadow-xl">

                {{-- Logo --}}
                <div class="mb-8 flex items-center gap-3">
                    <span class="grid h-12 w-12 place-items-center rounded-xl bg-amber-700 text-xl font-black text-white shadow-md">
                        LD
                    </span>
                    <div>
                        <p class="text-lg font-extrabold leading-tight text-stone-950">Liquor Drinks</p>
                        <p class="text-xs font-semibold uppercase tracking-widest text-amber-700">Admin Portal</p>
                    </div>
                </div>

                {{-- Heading --}}
                <h1 class="text-2xl font-black text-stone-950">Admin Sign In</h1>
                <p class="mt-1 text-sm text-stone-500">Restricted to authorized administrators only.</p>

                {{-- Error message --}}
                @if ($errors->any())
                    <div class="mt-5 flex items-start gap-3 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-rose-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-sm font-semibold text-rose-700">{{ $errors->first() }}</p>
                    </div>
                @endif

                {{-- Session status --}}
                @if (session('status'))
                    <div class="mt-5 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('admin.login') }}" class="mt-6 space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-stone-700">
                            Email Address
                        </label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            class="mt-1.5 w-full rounded-lg border-stone-300 bg-stone-50 text-sm shadow-sm
                                   transition focus:border-amber-700 focus:bg-white focus:ring-2 focus:ring-amber-700/20
                                   @error('email') border-rose-400 bg-rose-50 @enderror"
                            placeholder="admin@example.com"
                        >
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-semibold text-stone-700">
                            Password
                        </label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            class="mt-1.5 w-full rounded-lg border-stone-300 bg-stone-50 text-sm shadow-sm
                                   transition focus:border-amber-700 focus:bg-white focus:ring-2 focus:ring-amber-700/20"
                            placeholder="••••••••"
                        >
                    </div>

                    {{-- Remember me --}}
                    <div class="flex items-center gap-2">
                        <input
                            id="remember"
                            type="checkbox"
                            name="remember"
                            class="h-4 w-4 rounded border-stone-300 text-amber-700 focus:ring-amber-700"
                        >
                        <label for="remember" class="text-sm text-stone-600">Keep me signed in</label>
                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="w-full rounded-lg bg-amber-700 px-4 py-3 text-sm font-bold text-white
                               shadow-md transition hover:bg-amber-800 active:scale-[.98]"
                    >
                        Sign In as Admin
                    </button>
                </form>

                {{-- Divider --}}
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-stone-200"></div>
                    </div>
                    <div class="relative flex justify-center text-xs">
                        <span class="bg-white px-3 text-stone-400 font-medium">or</span>
                    </div>
                </div>

                {{-- Customer login link --}}
                <a
                    href="{{ route('login') }}"
                    class="block w-full rounded-lg border border-stone-300 bg-white px-4 py-3 text-center
                           text-sm font-bold text-stone-700 transition hover:bg-stone-50"
                >
                    Customer Login Instead
                </a>

                {{-- Back to store --}}
                <p class="mt-6 text-center text-sm text-stone-400">
                    <a href="{{ route('store.home') }}" class="font-semibold text-stone-500 hover:text-stone-900 hover:underline">
                        &larr; Back to Store
                    </a>
                </p>

            </div>

            {{-- Footer --}}
            <p class="mt-6 text-center text-xs text-stone-400">
                &copy; {{ date('Y') }} Liquor Drinks Online Store. All rights reserved.
            </p>
        </div>
    </div>

</body>
</html>
