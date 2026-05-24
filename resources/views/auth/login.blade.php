@extends('layouts.auth')

@section('title', 'Login | Liquor Lounge')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Welcome back,</h1>
    <p class="text-sm text-gray-500 mb-8">Login to manage liquors and inventory.</p>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email -->
        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full border-b border-gray-300 focus:border-yellow-500 focus:ring-0 outline-none py-2 text-gray-800"
                placeholder="example@email.com">

            @error('email')
                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Password</label>
            <input type="password" name="password" required
                class="w-full border-b border-gray-300 focus:border-yellow-500 focus:ring-0 outline-none py-2 text-gray-800"
                placeholder="••••••••">

            @error('password')
                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Forgot -->
        <div class="flex justify-end">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-xs text-gray-500 hover:text-yellow-600">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Button -->
        <button type="submit"
            class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-3 rounded-full transition">
            LOGIN
        </button>

        <!-- Social -->
        <button type="button"
            class="w-full border border-gray-300 hover:border-gray-400 text-gray-700 font-medium py-3 rounded-full transition">
            Connect with Facebook
        </button>
    </form>
@endsection

@section('right_title', 'New here?')
@section('right_text', 'Sign up and discover a premium liquor management experience.')

@section('right_button')
    <a href="{{ route('register') }}"
        class="inline-block border border-white px-10 py-3 rounded-full hover:bg-white hover:text-black transition font-semibold">
        REGISTER
    </a>
@endsection