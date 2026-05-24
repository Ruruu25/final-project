<x-guest-layout>
    <div class="mb-4">
        <h1 class="text-2xl font-bold text-center">Admin Login</h1>
    </div>
    @if ($errors->any())
        <div class="mb-4 font-medium text-red-600 text-center">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block font-medium">Email</label>
            <input id="email" class="w-full border border-gray-300 rounded px-3 py-2" type="email" name="email" required autofocus />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block font-medium">Password</label>
            <input id="password" class="w-full border border-gray-300 rounded px-3 py-2" type="password" name="password" required />
        </div>

        <div class="flex items-center justify-center">
            <button type="submit" class="px-4 py-2 bg-amber-700 text-white rounded hover:bg-amber-800">
                Login as Admin
            </button>
        </div>
    </form>
</x-guest-layout>