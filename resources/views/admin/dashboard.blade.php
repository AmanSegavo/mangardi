@extends('layouts.app')

@section('title', 'Dasbor Admin')

{{-- Bagian Header Halaman (Dengan Tambahan Notifikasi) --}}
@section('header')
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Dasbor Admin') }}
        </h2>

        {{-- ===== AWAL DARI BLOK NOTIFIKASI ===== --}}
        <div x-data="{ open: false }" class="relative">
            {{-- Ikon Lonceng Notifikasi --}}
            <button @click="open = !open" class="relative z-10 p-2 text-gray-400 hover:text-white focus:outline-none">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.012 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                </svg>
                {{-- Tanda Jumlah Notifikasi --}}
                @if(auth()->user() && auth()->user()->unreadNotifications->count())
                    <span class="absolute top-1 right-1 h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                    </span>
                @endif
            </button>

            {{-- Dropdown Notifikasi --}}
            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-80 md:w-96 bg-gray-800 border border-gray-700 rounded-lg shadow-xl z-20" style="display: none;">
                <div class="p-4 border-b border-gray-700">
                    <h3 class="text-white font-semibold">Notifikasi</h3>
                    @if(auth()->user())
                    <p class="text-sm text-gray-400">
                        Anda memiliki {{ auth()->user()->unreadNotifications->count() }} notifikasi belum dibaca.
                    </p>
                    @endif
                </div>
                <div class="max-h-96 overflow-y-auto">
                    @if(auth()->user())
                        @forelse(auth()->user()->unreadNotifications as $notification)
                            <a href="{{ route('admin.transactions.index') }}?mark_as_read={{ $notification->id }}" class="block px-4 py-3 text-sm text-gray-300 hover:bg-gray-700/50 transition-colors duration-150">
                                <p class="font-medium">{{ data_get($notification->data, 'message', 'Notifikasi tidak valid.') }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                            </a>
                        @empty
                            <div class="p-4 text-center text-gray-400">
                                Tidak ada notifikasi baru.
                            </div>
                        @endforelse
                    @endif
                </div>
                {{-- Anda bisa menambahkan link untuk melihat semua notifikasi di sini --}}
            </div>
        </div>
        {{-- ===== AKHIR DARI BLOK NOTIFIKASI ===== --}}
    </div>
@endsection

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

        {{-- Pesan Selamat Datang --}}
        @if(isset($user))
            <div class="bg-gray-800 shadow-sm rounded-lg p-5">
                <p class="text-gray-300 text-lg">
                    Selamat datang kembali, <strong class="font-semibold text-white">{{ $user->name }}</strong>!
                </p>
                <p class="text-gray-400 text-sm mt-1">Ini adalah ringkasan aktivitas terkini di platform Anda.</p>
            </div>
        @endif

        {{-- Grid Kartu Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Kartu Jumlah Pengguna -->
            <div class="bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6 flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-gray-400 uppercase">Jumlah Pengguna</p>
                    <p class="text-3xl font-bold text-white">{{ $stats['total_users'] ?? 0 }}</p>
                </div>
                <div class="text-gray-500">
                    <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m-7.5-2.962A3.375 3.375 0 0 1 9 12.25c0-1.03.418-1.968 1.1-2.656M12 21a9.094 9.094 0 0 0-3.741-.479 3 3 0 0 0-4.682 2.72M15 6.375a3.375 3.375 0 0 1-3 3.375c-1.03 0-1.968-.418-2.656-1.1M15 6.375a2.25 2.25 0 0 1 4.5 0" /></svg>
                </div>
            </div>

            <!-- Kartu Jumlah Game -->
            <div class="bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6 flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-gray-400 uppercase">Jumlah Game</p>
                    <p class="text-3xl font-bold text-white">{{ $stats['total_games'] ?? 0 }}</p>
                </div>
                <div class="text-gray-500">
                    <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" /></svg>
                </div>
            </div>

            <!-- Kartu Jumlah Transaksi -->
            <div class="bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6 flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-gray-400 uppercase">Jumlah Transaksi</p>
                    <p class="text-3xl font-bold text-white">{{ $stats['total_transactions'] ?? 0 }}</p>
                </div>
                <div class="text-gray-500">
                     <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.826-1.106-2.17 0-2.996a2.25 2.25 0 0 1 2.502-2.175 2.25 2.25 0 0 1 2.502 2.175" /></svg>
                </div>
            </div>

            <!-- Kartu Jumlah Pendapatan -->
            <div class="bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6 flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-gray-400 uppercase">Total Pendapatan</p>
                    {{-- Pastikan variabel $stats['total_revenue'] ada --}}
                    <p class="text-3xl font-bold text-white">RP {{ number_format($stats['total_revenue'] ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="text-gray-500">
                    <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                </div>
            </div>
        </div>

        {{-- Tabel Transaksi Terkini --}}
        <div class="bg-gray-800 shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-700 flex justify-between items-center">
                <h3 class="text-lg font-medium text-white">5 Transaksi Terkini</h3>
                <a href="{{ route('admin.transactions.index') }}" class="text-sm text-blue-400 hover:underline">Lihat Semua Transaksi →</a>
            </div>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-400">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-700/50">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Pengguna</th>
                            <th scope="col" class="px-6 py-3">Item</th>
                            <th scope="col" class="px-6 py-3">Jumlah</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr class="bg-gray-800 border-b border-gray-700 hover:bg-gray-700/50">
                                <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                    #{{ $transaction->id }}
                                </th>
                                <td class="px-6 py-4">{{ $transaction->user->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4">
                                    {{-- Kode ini sudah diperbaiki untuk menangani relasi yang mungkin null --}}
                                    {{ data_get($transaction, 'marketAccount.game.name') ?: data_get($transaction, 'diamondTopup.game.name') ?: 'Item Tidak Diketahui' }}
                                </td>
                                <td class="px-6 py-4">RP {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($transaction->status == 'completed' || $transaction->status == 'selesai') bg-green-900 text-green-300
                                        @elseif($transaction->status == 'pending') bg-yellow-900 text-yellow-300
                                        @else bg-red-900 text-red-300 @endif">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $transaction->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada transaksi terkini yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
