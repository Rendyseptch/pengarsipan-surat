<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-purple-500 via-pink-400 to-orange-300">

            {{-- LOGO --}}
            <div class="mb-6">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20 w-20 mx-auto drop-shadow-xl">
            </div>

            {{-- TITLE --}}
            <div class="text-center mb-6">
                <h1 class="text-4xl font-extrabold text-white drop-shadow-md">Aplikasi Pengarsipan</h1>
                <p class="text-purple-100 text-sm mt-2">Kelola arsipmu dengan mudah dan cepat </p>
            </div>

            {{-- CARD CONTAINER --}}
            <div class="w-full sm:max-w-md px-6 py-8
                        bg-white/20 backdrop-blur-xl shadow-2xl
                        rounded-3xl border border-white/30">

                <div class="text-white">
                    {{ $slot }}
                </div>
            </div>

            {{-- FOOTER --}}
            <p class="mt-6 text-sm text-white/90">
                &copy; {{ date('Y') }} Aplikasi Pengarsipan. All rights reserved.
            </p>
        </div>
    </body>
</html>
