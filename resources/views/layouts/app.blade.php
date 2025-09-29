<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- DataTables & SweetAlert --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- Latar belakang gradien ungu untuk seluruh aplikasi --}}
<body class="font-sans antialiased bg-gradient-to-br from-blue  -50 via-blue-100 to-blue-200">
    <div class="min-h-screen flex">

        {{-- Memanggil Sidebar "Floating" --}}
        @include('layouts.sidebar')

        {{-- Area Konten Utama --}}
        <div class="flex-1 md:ml-[18rem] p-4 pt-24">

            {{-- Slot untuk Header Halaman --}}
            @if (isset($header))
                <header class="mb-6">
                    <div class="max-w-7xl mx-auto">
                        {{ $header }}
                    </div>
                </header>
            @endif

            {{-- Slot untuk Konten Utama Halaman --}}
            <main>
                {{ $slot }}
            </main>
        </div>

    </div>

    {{-- Navbar "Floating" --}}
    {{-- Navbar ditempatkan di luar div utama agar posisinya fixed dengan benar --}}
    <div class="fixed top-4 left-4 md:left-[18rem] right-4 z-30 h-16 rounded-2xl bg-blue-900 backdrop-blur-lg shadow-lg flex items-center px-4 justify-between border border-white/10">
        @include('layouts.navigation')
    </div>

    {{-- Slot untuk script tambahan per halaman --}}
    @stack('scripts')
</body>
</html>

