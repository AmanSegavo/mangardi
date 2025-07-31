@extends('layouts.app')

@section('title', 'Pembayaran untuk ' . $account->title)

@section('header')
    <h2 class="font-semibold text-xl text-gray-200 leading-tight">
        Selesaikan Pembayaran
    </h2>
@endsection

@section('content')
<div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">
    {{-- Pesan Kesalahan --}}
    @if (session('error'))
        <div class="bg-red-500/20 text-red-300 p-4 rounded-lg mb-6" role="alert">
            {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
         <div class="bg-red-500/20 text-red-300 p-4 rounded-lg mb-6" role="alert">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('marketplace.buy.process') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="market_account_id" value="{{ $account->id }}">

        <div class="bg-gray-800 shadow-sm sm:rounded-lg">
            <div class="p-6 md:p-8 space-y-8">
                {{-- Bagian 1: Ringkasan Pembelian --}}
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4 border-b border-gray-700 pb-3">Ringkasan Pesanan</h3>
                    <div class="flex items-center gap-4">
                        <img src="{{ $account->images[0] ?? 'https://via.placeholder.com/80' }}" alt="{{ $account->title }}" class="h-16 w-16 object-cover rounded-lg">
                        <div>
                            <p class="font-semibold text-white">{{ $account->title }}</p>
                            <p class="text-sm text-gray-400">Untuk: {{ $account->game->name }}</p>
                            <p class="text-lg font-bold text-purple-400 mt-1">Jumlah: Rp {{ number_format($account->price, 2, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Bagian 2: Metode & Bukti Pembayaran --}}
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Detail Pembayaran</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="payment_method" class="block mb-2 text-sm font-medium text-gray-300">Metode Pembayaran</label>
                            <select id="payment_method" name="payment_method" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                <option value="" disabled selected>Pilih salah satu...</option>
                                <option value="Online Banking" {{ old('payment_method') == 'Online Banking' ? 'selected' : '' }}>Perbankan Online</option>
                                <option value="TNG eWallet" {{ old('payment_method') == 'TNG eWallet' ? 'selected' : '' }}>Dompet Digital (TNG)</option>
                                <option value="DuitNow QR" {{ old('payment_method') == 'DuitNow QR' ? 'selected' : '' }}>Pembayaran QR (DuitNow)</option>
                            </select>
                        </div>
                        <div>
                            <label for="payment_proof" class="block mb-2 text-sm font-medium text-gray-300">Unggah Bukti Pembayaran</label>
                            <input type="file" name="payment_proof" id="payment_proof" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-600/20 file:text-blue-300 hover:file:bg-blue-600/30" required>
                            <p class="mt-1 text-xs text-gray-500">Hanya file PNG, JPG, WEBP. Maksimal 2MB.</p>
                        </div>
                    </div>
                </div>

                {{-- Tombol Kirim --}}
                <div class="flex justify-end pt-4 gap-4 items-center">
                    <a href="{{ route('marketplace.show', $account) }}" class="text-sm text-gray-400 hover:text-white">Batal</a>
                    <button type="submit" class="px-6 py-3 text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-800 rounded-lg text-center">
                        Konfirmasi Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
