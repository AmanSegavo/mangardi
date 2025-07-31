@extends('layouts.app')

@section('title', 'Kelola Transaksi')

@section('header')
    <h2 class="font-semibold text-xl text-gray-200 leading-tight">
        Manajemen Transaksi
    </h2>
@endsection

@section('content')
<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">

    @if (session('success')) <div class="bg-green-500/20 text-green-300 p-4 rounded-lg mb-6" role="alert">{{ session('success') }}</div> @endif
    @if (session('error')) <div class="bg-red-500/20 text-red-300 p-4 rounded-lg mb-6" role="alert">{{ session('error') }}</div> @endif

    <div class="bg-gray-800 shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-100 border-b border-gray-700">
            <h3 class="text-lg font-medium text-white">Daftar Semua Transaksi</h3>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-400">
                <thead class="text-xs text-gray-400 uppercase bg-gray-700/50">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID / Tanggal</th>
                        <th scope="col" class="px-6 py-3">Pembeli</th>
                        <th scope="col" class="px-6 py-3">Detail Pembelian</th>
                        <th scope="col" class="px-6 py-3">Harga</th>
                        <th scope="col" class="px-6 py-3">Bukti Pembayaran</th>
                        <th scope="col" class="px-6 py-3">Tindakan / Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr class="bg-gray-800 border-b border-gray-700 hover:bg-gray-700/50">
                            {{-- Info Dasar --}}
                            <td class="px-6 py-4">
                                <span class="font-bold text-white">#{{ $transaction->id }}</span>
                                <span class="block text-xs text-gray-500">{{ $transaction->created_at->format('d M Y, H:i') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-white">{{ $transaction->user?->name ?? 'Pengguna Dihapus' }}</span>
                                <span class="block text-xs text-gray-500">{{ $transaction->user?->email }}</span>
                            </td>

                            {{-- Info Item (Top-up atau Beli Akun) --}}
                            <td class="px-6 py-4">
                                @if ($transaction->market_account_id)
                                    <span class="font-semibold text-white">[BELI AKUN] {{ $transaction->marketAccount?->title ?? 'Akun Dihapus' }}</span>
                                    <span class="block text-xs text-gray-500">{{ $transaction->marketAccount?->game?->name }}</span>
                                @else
                                    <span class="font-semibold text-white">[TOP UP] {{ $transaction->diamondTopup?->name ?? 'Paket Dihapus' }}</span>
                                    <span class="block text-xs text-gray-500">{{ $transaction->diamondTopup?->game?->name }}</span>
                                @endif
                            </td>

                            {{-- Harga --}}
                            <td class="px-6 py-4 font-semibold text-white">Rp {{ number_format($transaction->total_price, 2, ',', '.') }}</td>

                            {{-- Bukti Pembayaran --}}
                            <td class="px-6 py-4">
                                @if ($transaction->paymentProof?->file_path)
                                    <a href="{{ asset($transaction->paymentProof->file_path) }}" target="_blank" class="text-blue-400 hover:underline">Lihat Bukti</a>
                                @else
                                    <span class="text-gray-500">Tidak Ada</span>
                                @endif
                            </td>

                            {{-- Formulir Pembaruan Status --}}
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.transactions.updateStatus', $transaction) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="flex items-center gap-2">
                                        <select name="status" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5">
                                            <option value="pending" @selected($transaction->status == 'pending')>Tertunda</option>
                                            <option value="completed" @selected($transaction->status == 'completed' || $transaction->status == 'selesai')>Setujui (Selesai)</option>
                                            <option value="failed" @selected($transaction->status == 'failed')>Tolak (Gagal)</option>
                                        </select>
                                        <button type="submit" class="p-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800">
                                            Simpan
                                        </button>
                                    </div>
                                </form>
                                <span class="mt-2 text-xs px-2.5 py-1 inline-flex leading-5 font-semibold rounded-full
                                    @switch($transaction->status)
                                        @case('completed') @case('selesai') bg-green-900 text-green-300 @break
                                        @case('pending') bg-yellow-900 text-yellow-300 @break
                                        @default bg-red-900 text-red-300
                                    @endswitch">
                                    Status: {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-6 py-12 text-center text-gray-500">Tidak ada transaksi ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transactions->hasPages())
        <div class="p-4 border-t border-gray-700">{{ $transactions->links() }}</div>
        @endif
    </div>
</div>
@endsection
