@extends('layouts.app')

@section('title', 'MangardiStore - Pusat Top Up & Jual Beli Akun FF ML Terpercaya')

@section('background_image', asset('images/bgwelcome.png'))

@section('content')

{{-- 1. HERO SECTION --}}
<section class="text-center py-16 md:py-24 px-4">
    <div class="container mx-auto">
        <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight uppercase bg-gradient-to-r from-purple-500 via-pink-500 to-orange-500 bg-clip-text text-transparent animate-gradient-x">
            Pusat Jual Beli & Top Up
        </h1>
        <p class="mt-4 text-lg md:text-xl text-gray-300 max-w-3xl mx-auto">
            Platform Terpercaya untuk Kebutuhan Akun Sultan dan Diamond Game Anda. Proses Kilat, Aman, dan Terjamin.
        </p>
        <div class="mt-8">
            <a href="#katalog-preview" class="bg-purple-600 text-white font-semibold py-3 px-8 rounded-full text-lg hover:bg-purple-700 transform hover:scale-105 transition-all duration-300">
                Jelajahi Sekarang
            </a>
        </div>
    </div>
</section>

{{-- 2. BAGIAN LAYANAN --}}
<section id="layanan" class="py-12 px-4">
    <div class="container mx-auto">
        <x-section-heading title="Pilih Petualanganmu" />
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            {{-- Kartu kini dipanggil sebagai komponen yang kemas --}}
            <x-service-card
    :image="asset('images/FFF.webp')"
    title="Jual Akun Free Fire"
    route="accounts.ff"
    theme="purple">

    <x-slot:icon>
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-6 h-6 text-white">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
            </path>
        </svg>
    </x-slot:icon>

    Temukan akun sultan Free Fire idamanmu, lengkap dengan skin langka dan level tinggi.
</x-service-card>


            <x-service-card
    :image="$ml_image ?? asset('images/ML.png')"
    title="Jual Akun Mobile Legends"
    route="accounts.ml"
    theme="blue">

    <x-slot:icon>
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
            </path>
        </svg>
    </x-slot:icon>

    Raih kemenangan dengan akun ML rank Mythic dan koleksi skin Epic terlengkap.
</x-service-card>

            <x-service-card
    :image="$topup_image ?? asset('images/diamond.png')"
    title="Top Up Diamond"
    route="topup.index"
    theme="green">

    <x-slot:icon>
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-6 h-6 text-white">
            <path stroke-linecap="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8v1m0 6v1m6-4H6"></path>
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375"></path>
        </svg>
    </x-slot:icon>

    Isi ulang Diamond FF & ML dengan harga termurah dan proses otomatis hanya hitungan detik.
</x-service-card>

        </div>
    </div>
</section>

{{-- 3. BAGIAN "KENAPA KAMI?" --}}
<section class="bg-gray-900/70 backdrop-blur-sm py-20 px-4">
    <div class="container mx-auto">
        <x-section-heading title="Kenapa Memilih MangardiStore?" />
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
             <x-feature-card title="Proses Kilat">
                <x-slot:icon><svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></x-slot:icon>
                Pesanan diproses secara otomatis dan selesai dalam hitungan detik.
            </x-feature-card>
            <x-feature-card title="Aman & Terpercaya">
                <x-slot:icon><svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg></x-slot:icon>
                Jaminan keamanan transaksi dan data privasi Anda adalah prioritas kami.
            </x-feature-card>
            <x-feature-card title="Harga Terbaik">
                <x-slot:icon><svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8v1m0 6v1m6-4H6"></path></svg></x-slot:icon>
                Dapatkan penawaran harga paling kompetitif di pasaran.
            </x-feature-card>
            <x-feature-card title="Layanan 24/7">
                 <x-slot:icon><svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></x-slot:icon>
                Butuh bantuan? Tim support kami siap melayani Anda kapan saja.
            </x-feature-card>
        </div>
    </div>
</section>

{{-- =================================================== --}}
{{-- 4. BAHAGIAN KATALOG PRODUK DINAMIK (BARU) --}}
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

{{-- CSS tambahan untuk animasi gradient (Tidak berubah) --}}
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
