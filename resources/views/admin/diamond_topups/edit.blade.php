@extends('layouts.app')

@section('title', 'Kemaskini Pakej Top-up')

@section('header')
    <h2 class="font-semibold text-xl text-gray-200 leading-tight">
        {{ __('Kemaskini Pakej: ') }} <span class="text-gray-400">{{ $diamondTopup->name }}</span>
    </h2>
@endsection

@section('content')
<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-gray-800 shadow-sm sm:rounded-lg">
        <div class="p-6 md:p-8">
            <form method="POST" action="{{ route('admin.diamond-topups.update', $diamondTopup) }}">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <!-- Game -->
                    <div>
                        <label for="game_id" class="block mb-2 text-sm font-medium text-gray-300">Game</label>
                        <select id="game_id" name="game_id" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option disabled>Pilih satu game</option>
                            @foreach($games as $game)
                                <option value="{{ $game->id }}" @selected(old('game_id', $diamondTopup->game_id) == $game->id)>
                                    {{ $game->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('game_id') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Nama Pakej -->
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-300">Nama Pakej</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $diamondTopup->name) }}" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('name') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Jumlah & Harga -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="amount" class="block mb-2 text-sm font-medium text-gray-300">Jumlah Diamond</label>
                            <input type="number" name="amount" id="amount" value="{{ old('amount', $diamondTopup->amount) }}" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @error('amount') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-300">Harga (RM)</label>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $diamondTopup->price) }}" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @error('price') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Butang Tindakan -->
                <div class="flex items-center justify-end mt-8">
                    <a href="{{ route('admin.diamond-topups.index') }}" class="text-sm text-gray-400 hover:text-white mr-4">
                        Batal
                    </a>
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 rounded-lg text-center">
                        Kemaskini Pakej
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
