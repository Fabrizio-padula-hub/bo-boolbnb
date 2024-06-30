<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .logo {
            font-family: 'Pacifico', cursive;
            font-size: 3rem;
        }

        .logo i {
            margin-right: 0.5rem;
            font-size: 2.5rem;
        }

        .logo:hover {
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen  bg-black flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
        <div>
            <h1 class="logo flex items-center text-white hover:text-indigo-500"><i class="fas fa-home"></i><a
                    href="{{ route('home') }}">BoolBnb</a></h1>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white/10 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
