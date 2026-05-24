@extends('layouts.auth')

@section('title', 'Register | Liquor Lounge')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Create Account</h1>
    <p class="text-sm text-gray-500 mb-8">Register to access Liquor Lounge dashboard.</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus
                class="w-full border-b border-gray-300 focus:border-yellow-500 focus:ring-0 outline-none py-2 text-gray-800"
                placeholder="Juan Dela Cruz">

            @error('name')
                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
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

        <!-- Confirm Password -->
        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Confirm Password</label>
            <input type="password" name="password_confirmation" required
                class="w-full border-b border-gray-300 focus:border-yellow-500 focus:ring-0 outline-none py-2 text-gray-800"
                placeholder="••••••••">
        </div>

        <!-- Button -->
        <button type="submit"
            class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-3 rounded-full transition">
            REGISTER
        </button>

        <p class="text-sm text-gray-500 text-center">
            Already have an account?
            <a href="{{ route('login') }}" class="text-yellow-600 font-semibold hover:underline">Login</a>
        </p>
    </form>
@endsection

@section('right_title', 'Already a member?')
@section('right_text', 'Login and continue managing your liquor inventory and orders.')

@section('right_button')
    <a href="{{ route('login') }}"
        class="inline-block border border-white px-10 py-3 rounded-full hover:bg-white hover:text-black transition font-semibold">
        LOGIN
    </a>
@endsection