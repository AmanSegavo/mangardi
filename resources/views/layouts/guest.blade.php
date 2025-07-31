<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Judul halaman akan diambil dari setiap view, dengan default config('app.name') --}}
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts & Styles -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- CSS Inline untuk latar belakang -->
    <style>
        body.has-bg-image {
            background-image: url('{{ asset('images/background.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-300 has-bg-image">
    <!-- Lapisan Overlay Gelap -->
    <div class="absolute inset-0 bg-black/80 z-0"></div>

    {{-- Kontainer yang memusatkan konten secara vertikal dan horizontal --}}
    <div class="relative min-h-screen flex flex-col justify-center items-center px-4">

        {{-- Logo yang Tampil di Atas Form --}}
        <div class="mb-4">
            <a href="/" class="text-4xl font-black tracking-wider bg-gradient-to-r from-purple-400 via-pink-500 to-orange-400 bg-clip-text text-transparent hover:opacity-80 transition-opacity">
                MANGARDI
            </a>
        </div>

        {{-- Di sinilah konten form (login/register) akan dimasukkan --}}
        @yield('content')

    </div>
</body>
</html>
