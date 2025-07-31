@extends('layouts.app')

@section('title', 'Dasbor Pengguna')

{{-- Bagian ini akan mengisi @yield('header') di layout utama. Kita sederhanakan. --}}
@section('header')
    {{ __('Dasbor') }}
@endsection

{{-- Bagian ini akan mengisi @yield('content') dengan gaya baru --}}
@section('content')
<div class="space-y-8">

    {{-- 1. Kotak Selamat Datang yang Telah Ditingkatkan --}}
    {{-- Menggunakan gradient, bayangan, dan teks yang lebih menonjol --}}
    <div class="relative overflow-hidden rounded-xl bg-gray-800/80 p-8 shadow-2xl shadow-black/20 border border-gray-700/60
                bg-gradient-to-br from-purple-600/20 to-gray-800/60 backdrop-blur-lg">
        <h3 class="text-3xl font-bold text-white">Selamat Datang Kembali, {{ Auth::user()->name }}!</h3>
        <p class="mt-2 text-gray-300 max-w-lg">Tingkatkan pengalaman bermainmu. Top up diamond atau temukan akun impianmu di sini.</p>
        <a href="{{ route('welcome') }}" class="mt-6 inline-flex items-center gap-3 bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
            </svg>
            Jelajahi Toko
        </a>
    </div>

    {{-- 2. Kotak Transaksi Terkini dengan Gaya "Glass" --}}
    <div class="bg-gray-800/60 backdrop-blur-lg overflow-hidden shadow-2xl shadow-black/20 rounded-xl border border-gray-700/60">
        <div class="p-6 md:p-8">
            <h4 class="text-xl font-bold mb-5 text-white">Riwayat Transaksi Terakhir</h4>

            @if($transactions->isNotEmpty())
                <div class="flow-root">
                    <ul role="list" class="-my-4 divide-y divide-gray-700/50">
                        @foreach($transactions as $transaction)
                            {{-- Desain baru yang lebih responsif untuk setiap item transaksi --}}
                            <li class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 py-4">
                                <div class="flex items-center flex-grow w-full">
                                    {{-- Gambar Game --}}
                                    <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-700">
                                        <img src="{{ $transaction->diamondTopup?->game?->image_url ?? 'https://via.placeholder.com/64' }}" alt="Ikon Game" class="h-full w-full object-cover object-center">
                                    </div>

                                    {{-- Info Transaksi --}}
                                    <div class="ml-4 flex flex-1 flex-col">
                                        <div class="flex justify-between text-base font-medium text-white">
                                            <h3>
                                                {{ $transaction->diamondTopup?->name ?? 'Paket Tidak Tersedia' }}
                                            </h3>
                                            <p class="ml-4">Rp {{ number_format($transaction->total_price ?? 0, 0, ',', '.') }}</p>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-400">
                                            Game: {{ $transaction->diamondTopup?->game?->name ?? 'Game Tidak Tersedia' }}
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $transaction->created_at->isoFormat('dddd, D MMMM Y, HH:mm') }}</p>
                                    </div>
                                </div>

                                {{-- Status (ditempatkan di sini agar rapi di mobile) --}}
                                <div class="w-full sm:w-auto text-center sm:text-right mt-4 sm:mt-0 sm:ml-6 flex-shrink-0">
                                    <span class="text-xs px-3 py-1.5 inline-flex font-semibold rounded-full tracking-wide
                                        @switch($transaction->status)
                                            @case('completed')
                                            @case('selesai')
                                                bg-green-500/20 text-green-300 ring-1 ring-inset ring-green-500/30
                                                @break
                                            @case('pending')
                                                bg-yellow-500/20 text-yellow-300 ring-1 ring-inset ring-yellow-500/30
                                                @break
                                            @case('failed')
                                            @case('gagal')
                                                bg-red-500/20 text-red-300 ring-1 ring-inset ring-red-500/30
                                                @break
                                            @default
                                                bg-gray-500/20 text-gray-300 ring-1 ring-inset ring-gray-500/30
                                        @endswitch">
                                        {{ Str::ucfirst($transaction->status) }}
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="text-center mt-8">
                    <a href="{{ route('transactions.index') }}" class="text-sm font-medium text-purple-400 hover:text-purple-300 hover:underline">
                        Lihat Semua Riwayat Transaksi →
                    </a>
                </div>
            @else
                {{-- Desain baru jika tidak ada transaksi --}}
                <div class="text-center py-12 px-6 bg-gray-900/50 rounded-lg border border-dashed border-gray-700">
                    <svg class="mx-auto h-12 w-12 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-semibold text-white">Riwayat Transaksi Kosong</h3>
                    <p class="mt-1 text-sm text-gray-400">Semua pembelian Anda akan muncul di sini. Ayo mulai transaksi pertamamu!</p>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
