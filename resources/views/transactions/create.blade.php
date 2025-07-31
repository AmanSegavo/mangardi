<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Top Up untuk: ') }} {{ $game->name }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-100">
                @if (session('error'))
                    <div class="bg-red-500 text-white p-4 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('topup.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="game_id" value="{{ $game->id }}">

                    <!-- Maklumat Akaun -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-purple-400 mb-2">1. Masukkan Maklumat Akaun</h3>
                        <div>
                            <label for="player_id" class="block text-sm font-medium text-gray-300">Player ID</label>
                            <input type="text" name="player_id" id="player_id" value="{{ old('player_id') }}" placeholder="Contoh: 12345678" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-purple-500 focus:border-purple-500 sm:text-sm" required>
                            @error('player_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Pilih Pakej -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-purple-400 mb-2">2. Pilih Pakej Top-Up</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($diamondTopups as $package)
                            <label class="block cursor-pointer">
                                <input type="radio" name="diamond_topup_id" value="{{ $package->id }}" class="peer sr-only" required>
                                <div class="p-4 bg-gray-700 rounded-lg text-center peer-checked:ring-2 peer-checked:ring-purple-500 hover:bg-gray-600 transition-colors">
                                    <p class="font-bold">{{ $package->name }}</p>
                                    <p class="text-sm text-gray-400">{{ $package->amount }} Diamonds</p>
                                    <p class="mt-2 text-lg text-purple-400">RM {{ number_format($package->price, 2) }}</p>
                                </div>
                            </label>
                            @endforeach
                        </div>
                        @error('diamond_topup_id') <span class="text-red-400 text-sm mt-2 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Pembayaran -->
                    <div class="mb-6">
                         <h3 class="text-lg font-medium text-purple-400 mb-2">3. Kaedah Pembayaran</h3>
                         <div>
                            <label for="payment_method" class="block text-sm font-medium text-gray-300">Pilih Kaedah Bayaran</label>
                            <select name="payment_method" id="payment_method" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-purple-500 focus:border-purple-500 sm:text-sm" required>
                                <option value="bank_transfer">Pindahan Bank</option>
                                <option value="tng_ewallet">Touch 'n Go eWallet</option>
                                <option value="grabpay">GrabPay</option>
                            </select>
                             @error('payment_method') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>
                         <div class="mt-4">
                            <label for="payment_proof" class="block text-sm font-medium text-gray-300">Muat Naik Bukti Pembayaran</label>
                            <input type="file" name="payment_proof" id="payment_proof" class="mt-1 block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-700" required>
                            @error('payment_proof') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                         </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                            Sahkan Top-Up
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
