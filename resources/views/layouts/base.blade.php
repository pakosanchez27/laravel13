<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    @fonts

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body>

    <header class="bg-purple-950 py-5">
        <div class="max-w-6xl mx-auto flex flex-col lg:flex-row items-center lg:justify-between">

            <div class="w-full max-w-100">
                <img src="{{ asset('img/logo.svg') }}" alt="Logo" class="w-full block" />
            </div>

            @if (Route::has('login'))
            <nav class="flex flex-col lg:flex-row items-center gap-4">
                <a
                    href="{{ route('login') }}"
                    class=" uppercase text-white font-bold text-lg hover:text-gray-300 transition-colors duration-300"
                >Iniciar Sesión</a>
                <a
                    href="{{ route('register') }}"
                    class=" font-bold text-lg hover:text-amber-300 transition-colors duration-300 ml-6 uppercase border-2 border-amber-500 px-5 py-2 text-amber-500"
                >Registrarse</a>
            </nav>
            @endif
        </div>
    </header>


    @yield('content')

</body>

</html>
