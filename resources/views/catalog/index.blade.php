@extends('layouts.app')

@section('title', 'MangardiStore - Pusat Top Up & Jual Beli Akun FF ML Terpercaya')

@section('background_image', asset('images/bgwelcome.png'))

@section('content')

{{-- 1. HERO SECTION (DIKEMASKINI DENGAN BUTANG BARU) --}}
<section class="text-center py-16 md:py-24 px-4">
    <div class="container mx-auto">
        <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight uppercase bg-gradient-to-r from-purple-500 via-pink-500 to-orange-500 bg-clip-text text-transparent animate-gradient-x">
            Pusat Jual Beli & Top Up
        </h1>
        <p class="mt-4 text-lg md:text-xl text-gray-300 max-w-3xl mx-auto">
            Platform Terpercaya untuk Kebutuhan Akun Sultan dan Diamond Game Anda. Proses Kilat, Aman, dan Terjamin.
        </p>
        {{-- DIKEMASKINI: Dua butang untuk pilihan yang jelas --}}
        <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="#katalog-preview" class="w-full sm:w-auto bg-purple-600 text-white font-semibold py-3 px-8 rounded-full text-lg hover:bg-purple-700 transform hover:scale-105 transition-all duration-300">
                Jelajahi Sekarang
            </a>
            <a href="{{ route('catalog.index') }}" class="w-full sm:w-auto bg-transparent border-2 border-purple-400 text-purple-400 font-semibold py-3 px-8 rounded-full text-lg hover:bg-purple-400 hover:text-gray-900 transition-all duration-300">
                Lihat Semua Katalog
            </a>
        </div>
    </div>
</section>

{{-- 2. BAGIAN LAYANAN (Tidak berubah) --}}
{{-- ... (kod sedia ada untuk 'Pilih Petualanganmu' dikekalkan) ... --}}
<section id="layanan" class="py-12 px-4">
    {{-- ... kod anda di sini ... --}}
</section>


{{-- 3. BAGIAN "KENAPA KAMI?" (Tidak berubah) --}}
{{-- ... (kod sedia ada untuk 'Kenapa Memilih MangardiStore?' dikekalkan) ... --}}
<section class="bg-gray-900/70 backdrop-blur-sm py-20 px-4">
    {{-- ... kod anda di sini ... --}}
</section>


{{-- =================================================== --}}
{{-- 4. BAHAGIAN KATALOG PRODUK (BARU) --}}
{{-- =================================================== --}}
<section id="katalog-preview" class="py-20 px-4">
    <div class="container mx-auto">
        <x-section-heading title="Jelajahi Katalog Kami" />

        {{-- Pratonton Akaun Dijual --}}
        <div class="mb-16">
            <h3 class="text-2xl font-bold text-white mb-6">Akun Terbaru di Pasaran</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse ($marketAccounts as $account)
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg transform hover:-translate-y-2 transition-transform duration-300 group">
                        <a href="#"> {{-- TODO: Buat route untuk halaman detail akaun --}}
                            <div class="relative">
                                <img class="h-48 w-full object-cover object-center"
                                     src="{{ asset($account->images[0] ?? 'https://via.placeholder.com/400x300.png/1a202c/ffffff?text=No+Image') }}"
                                     alt="Gambar {{ $account->title }}">
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                                    <span class="text-white text-lg font-bold opacity-0 group-hover:opacity-100 transition-opacity duration-300">Lihat Detail</span>
                                </div>
                            </div>
                        </a>
                        <div class="p-4">
                            <span class="inline-block bg-purple-600 text-white text-xs font-semibold px-2.5 py-1 rounded-full mb-2">
                                {{ $account->game->name }}
                            </span>
                            <h4 class="text-lg font-semibold text-white mb-2 h-14 truncate">{{ $account->title }}</h4>
                            <p class="text-xl font-bold text-green-400">
                                Rp {{ number_format($account->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 bg-gray-800/50 rounded-lg">
                        <p class="text-gray-400">Belum ada akun yang dijual saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Pratonton Top-Up --}}
<div>
    <h3 class="text-2xl font-bold text-white mb-6">Tersedia Top Up Untuk</h3>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
        @forelse ($gamesForTopup as $game)
            {{-- PERUBAHAN DI SINI --}}
            <a href="{{ route('topup.create', $game->slug) }}" class="group block bg-gray-800 p-4 rounded-lg text-center shadow-lg transform hover:-translate-y-1 transition-transform duration-300">
                <img class="h-24 w-24 rounded-lg mx-auto mb-4 transition-transform duration-300 group-hover:scale-110"
                     src="{{ asset($game->logo_path ?? 'https://via.placeholder.com/150x150.png/1a202c/ffffff?text='.$game->name) }}"
                     alt="Logo {{ $game->name }}">
                <h4 class="text-base font-semibold text-white">{{ $game->name }}</h4>
            </a>
        @empty
            <div class="col-span-full text-center py-12 bg-gray-800/50 rounded-lg">
                <p class="text-gray-400">Layanan top-up belum tersedia.</p>
            </div>
        @endforelse
    </div>
</div>
    </div>
</section>


@push('styles')
<style>
    @keyframes gradient-x {
        0%, 100% { background-size: 200% 200%; background-position: left center; }
        50% { background-size: 200% 200%; background-position: right center; }
    }
    .animate-gradient-x { animation: gradient-x 5s ease infinite; }
</style>
@endpush
@endsection
