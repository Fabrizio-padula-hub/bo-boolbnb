<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BoolBnb</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/generic.css', 'resources/js/app.js'])
</head>

<body class="dark:bg-black h-dvh">
    <div class="antialiased w-full dark:text-slate-300 relative h-full">
        <div class="flex flex-col justify-center items-center h-full">
            <div class="flex items-center xl:text-9xl text-6xl hover:text-indigo-500">
                @if (Route::has('login'))
                    <a href="{{ url('admin/dashboard') }}" class="logo"><i
                            class="fas fa-home"></i>{{ __('BoolBnb') }}</a>
                @else
                    <a href="{{ url('admin/dashboard') }}" class="logo"><i
                            class="fas fa-home"></i>{{ __('BoolBnb') }}</a>
                @endif
            </div>
            @if (Route::has('login'))
                <div class="px-6 py-4">
                    @auth
                        <a href="{{ url('admin/dashboard') }}"
                            class="link text-lg text-black dark:text-white underline hover:text-indigo-500">{{ __('Dashboard') }}</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="link text-lg text-black dark:text-white underline hover:text-indigo-500">{{ __('Accedi') }}</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="link ml-4 text-lg text-black dark:text-white underline hover:text-indigo-500">{{ __('Registrati') }}</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</body>

</html>
