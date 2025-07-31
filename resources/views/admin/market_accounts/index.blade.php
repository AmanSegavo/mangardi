@extends('layouts.app')

@section('title', 'Kelola Akun Jualan')

@section('header')
    <h2 class="font-semibold text-xl text-gray-200 leading-tight">
        {{ __('Kelola Akun Jualan') }}
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Menggunakan komponen alert untuk pesan sukses atau error --}}
        <x-alert type="success" :message="session('success')" />
        <x-alert type="danger" :message="session('error')" />

        <div class="bg-gray-800 shadow-xl sm:rounded-lg overflow-hidden">
            {{-- Bagian Header dengan Tombol Tambah --}}
            <div class="p-6 flex justify-between items-center border-b border-gray-700">
                <div>
                    <h3 class="text-lg font-semibold text-white">Daftar Akun untuk Dijual</h3>
                    <p class="text-sm text-gray-400 mt-1">Lihat dan kelola semua akun yang tersedia di pasar.</p>
                </div>
                <a href="{{ route('admin.market-accounts.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-blue-500 transition ease-in-out duration-150">
                    Tambah Akun
                </a>
            </div>

            {{-- Tabel Data --}}
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-400">
                    <thead class="text-xs text-gray-300 uppercase bg-gray-700/50">
                        <tr>
                            <th scope="col" class="px-6 py-3 min-w-[250px]">Judul Penjualan</th>
                            <th scope="col" class="px-6 py-3">Game</th>
                            <th scope="col" class="px-6 py-3">Harga</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($accounts as $account)
                        <tr class="bg-gray-800 border-b border-gray-700 hover:bg-gray-700/60 transition-colors duration-200">
                            <td class="px-6 py-4 font-medium text-white whitespace-nowrap">{{ Str::limit($account->title, 40) }}</td>
                            <td class="px-6 py-4">{{ $account->game->name }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($account->price, 2, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                {{-- Menggunakan komponen badge, lebih rapi! --}}
                                @php
                                    $statusType = match($account->status) {
                                        'available' => 'success',
                                        'pending' => 'warning',
                                        'sold' => 'danger',
                                        default => 'info'
                                    };
                                @endphp
                                <x-badge :type="$statusType">{{ ucfirst($account->status) }}</x-badge>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end items-center gap-4">
                                    <a href="{{ route('admin.market-accounts.edit', $account) }}" class="font-medium text-blue-400 hover:text-blue-300 hover:underline">Ubah</a>

                                    {{-- Formulir hapus yang lebih aman dan terpisah --}}
                                    <form action="{{ route('admin.market-accounts.destroy', $account) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini? Tindakan ini tidak dapat dibatalkan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-500 hover:text-red-400 hover:underline">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        {{-- Keadaan kosong yang lebih ramah pengguna --}}
                        <tr>
                            <td colspan="5">
                                <div class="text-center py-16 px-6">
                                    <svg class="mx-auto h-12 w-12 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-semibold text-white">Tidak ada akun ditemukan</h3>
                                    <p class="mt-1 text-sm text-gray-400">Mulailah dengan menambahkan akun penjualan baru.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginasi (pastikan Anda telah mempublikasikan view paginasi untuk Tailwind) --}}
            @if ($accounts->hasPages())
                <div class="p-4 border-t border-gray-700 bg-gray-800/50">
                    {{ $accounts->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
