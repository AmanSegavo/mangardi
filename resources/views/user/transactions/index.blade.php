@extends('layouts.app')

@section('title', 'Sejarah Transaksi Saya')

@section('header')
    <h2 class="font-semibold text-xl text-gray-200 leading-tight">
        Sejarah Transaksi Saya
    </h2>
@endsection

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Notifikasi Kejayaan --}}
        @if (session('success'))
            <div class="bg-green-500/20 text-green-300 p-4 rounded-lg mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-gray-800 shadow-sm sm:rounded-lg">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-400">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-700/50">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID Pesanan</th>
                            <th scope="col" class="px-6 py-3">Item</th>
                            <th scope="col" class="px-6 py-3">Harga</th>
                            <th scope="col" class="px-6 py-3">Tarikh</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            {{-- Anda boleh tambah pautan ke 'show' jika perlu --}}
                            {{-- <th scope="col" class="px-6 py-3">Tindakan</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr class="bg-gray-800 border-b border-gray-700 hover:bg-gray-700/50">
                                <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                    #{{ $transaction->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $transaction->diamondTopup->name ?? 'N/A' }}
                                    <span class="block text-xs text-gray-500">{{ $transaction->account->game->name ?? '' }}</span>
                                </td>
                                <td class="px-6 py-4">RM {{ number_format($transaction->total_price, 2) }}</td>
                                <td class="px-6 py-4">{{ $transaction->created_at->format('d M Y, H:i A') }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($transaction->status == 'completed' || $transaction->status == 'selesai') bg-green-900 text-green-300
                                        @elseif($transaction->status == 'pending') bg-yellow-900 text-yellow-300
                                        @else bg-red-900 text-red-300 @endif">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                                {{-- <td class="px-6 py-4">
                                    <a href="{{ route('transactions.show', $transaction) }}" class="font-medium text-blue-400 hover:underline">Lihat Detail</a>
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    Anda belum mempunyai sebarang transaksi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginasi --}}
            @if ($transactions->hasPages())
            <div class="p-4 border-t border-gray-700">
                {{ $transactions->links() }}
            </div>
            @endif
        </div>
    </div>
@endsection
