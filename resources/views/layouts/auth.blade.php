<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Liquor Lounge')</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-gray-100 flex items-center justify-center px-6">

    <div class="w-full max-w-5xl bg-white shadow-xl rounded-xl overflow-hidden grid grid-cols-1 md:grid-cols-2">

        <!-- LEFT FORM -->
        <div class="p-10 flex flex-col justify-center">
            @yield('content')
        </div>

        <!-- RIGHT IMAGE PANEL -->
        <div class="relative hidden md:flex items-center justify-center bg-cover bg-center"
            style="background-image: url('{{ asset('assets/images/login.png') }}');">

            <!-- Dark overlay -->
            <div class="absolute inset-0 bg-black/60"></div>

            <div class="relative text-center text-white px-10">
                <h2 class="text-3xl font-semibold mb-4">
                    @yield('right_title', 'New here?')
                </h2>

                <p class="text-sm text-gray-200 leading-relaxed mb-6">
                    @yield('right_text', 'Sign up and discover premium liquor management experience.')
                </p>

                @yield('right_button')
            </div>
        </div>

    </div>

</body>
</html>