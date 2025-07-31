@extends('layouts.app')

@section('title', 'Top-up ' . $game->name)

@section('header')
    <h2 class="font-semibold text-xl text-gray-200 leading-tight">
        Lengkapkan Pesanan Anda
    </h2>
@endsection

@section('content')
<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
    {{-- Mesej Ralat --}}
    @if (session('error'))
        <div class="bg-red-500/20 text-red-300 p-4 rounded-lg mb-6" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('topup.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="game_id" value="{{ $game->id }}">

        <div class="bg-gray-800 shadow-sm sm:rounded-lg">
            <div class="p-6 md:p-8 space-y-8">

                {{-- Bahagian 1: Info Permainan & ID Pemain --}}
                <div>
                    <div class="flex items-center gap-4 mb-4">
                        <img src="{{ $game->image_url ?? 'https://via.placeholder.com/80' }}" alt="{{ $game->name }}" class="h-16 w-16 object-cover rounded-lg">
                        <div>
                            <h3 class="text-2xl font-bold text-white">{{ $game->name }}</h3>
                            <p class="text-sm text-gray-400">Sila masukkan ID Pemain anda.</p>
                        </div>
                    </div>
                    <div>
                        <label for="player_id" class="block mb-2 text-sm font-medium text-gray-300 sr-only">Player ID</label>
                        <input type="text" name="player_id" id="player_id" value="{{ old('player_id') }}" placeholder="Masukkan Player ID anda di sini" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        @error('player_id') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Bahagian 2: Pilih Pakej Diamond --}}
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Pilih Pakej Top-up</h3>
                    @error('diamond_topup_id') <p class="mb-2 text-sm text-red-500">{{ $message }}</p> @enderror
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @forelse($diamondTopups as $topup)
                            <label class="relative">
                                <input type="radio" name="diamond_topup_id" value="{{ $topup->id }}" class="sr-only peer" {{ old('diamond_topup_id') == $topup->id ? 'checked' : '' }}>
                                <div class="p-4 bg-gray-700 rounded-lg cursor-pointer text-center peer-checked:ring-2 peer-checked:ring-blue-500 peer-checked:bg-gray-600 hover:bg-gray-600/70 transition-all duration-200">
                                    <p class="font-semibold text-white">{{ $topup->name }}</p>
                                    <p class="text-xs text-gray-400">RM {{ number_format($topup->price, 2) }}</p>
                                </div>
                            </label>
                        @empty
                            <p class="text-gray-400 col-span-full">Tiada pakej top-up tersedia untuk game ini.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Bahagian 3: Kaedah & Bukti Pembayaran --}}
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Pembayaran</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="payment_method" class="block mb-2 text-sm font-medium text-gray-300">Kaedah Pembayaran</label>
                            <select id="payment_method" name="payment_method" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                <option value="" disabled selected>Pilih satu...</option>
                                <option value="Online Banking" {{ old('payment_method') == 'Online Banking' ? 'selected' : '' }}>Online Banking</option>
                                <option value="TNG eWallet" {{ old('payment_method') == 'TNG eWallet' ? 'selected' : '' }}>TNG eWallet</option>
                                <option value="DuitNow QR" {{ old('payment_method') == 'DuitNow QR' ? 'selected' : '' }}>DuitNow QR</option>
                            </select>
                            @error('payment_method') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="payment_proof" class="block mb-2 text-sm font-medium text-gray-300">Muat Naik Bukti Pembayaran</label>
                            <input type="file" name="payment_proof" id="payment_proof" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-600/20 file:text-blue-300 hover:file:bg-blue-600/30" required>
                            <p class="mt-1 text-xs text-gray-500">Fail PNG, JPG, JPEG sahaja. Maksimum 2MB.</p>
                            @error('payment_proof') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Butang Hantar --}}
                <div class="flex justify-end pt-4">
                    <button type="submit" class="px-6 py-3 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 rounded-lg text-center">
                        Hantar Pesanan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
