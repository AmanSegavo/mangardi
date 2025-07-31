<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- ======================================================= --}}
    {{--    LOGIK UNTUK LATAR BELAKANG DINAMIK (TELAH DIPINDAHKAN KE SINI) --}}
    {{-- ======================================================= --}}
    @hasSection('background_image')
    @push('styles')
    <style>
        .has-bg-image {
            background-image: url('@yield('background_image')');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }
    </style>
    @endpush
    @endif
    {{-- ======================================================= --}}

    {{-- Stack ini akan mencetak gaya yang baru ditolak di atas --}}
    @stack('styles')

</head>
<body
    @class([
        'h-full font-sans antialiased bg-gray-900 text-gray-200',
        'has-bg-image' => View::hasSection('background_image'), // Ini akan tetap berfungsi seperti biasa
    ])
>
    <div class="relative min-h-screen">

        {{-- Lapisan Overlay Dinamik --}}
        <div class="absolute inset-0 @yield('overlay_opacity', 'bg-black/80') z-0"></div>

        {{-- Konten Utama (di atas overlay) --}}
        <div class="relative z-10 flex flex-col min-h-screen">

            <header class="flex-shrink-0">
                @include('layouts.navigation')
            </header>

            <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex-grow">

                @hasSection('header')
                <header class="py-10">
                    <div class="border-b border-white/10 pb-5">
                        @yield('header')
                    </div>
                </header>
                @endif

                <main class="py-8">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    @stack('scripts')

    {{-- Blok logik lama di bawah sini telah dibuang --}}

</body>
</html>
