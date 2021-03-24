<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UX-SAD') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
<div class="md:flex flex-col md:flex-row min-h-screen w-full">
    @include('layouts.navigation')
    <div class="w-full md:w-4/5 flex-grow bg-gray-100 py-16 px-8">
        <!-- Page Heading -->
        <header class="bg-white sm:rounded-t-lg pt-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </header>

        <main>
            {{ $slot }}
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://kit.fontawesome.com/25f92f4258.js" crossorigin="anonymous"></script>
</body>
</html>
