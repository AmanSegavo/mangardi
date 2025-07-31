@extends('layouts.app')
@section('title', 'Perbarui Akun Jualan')
@section('header')<h2 class="font-semibold text-xl text-gray-200 leading-tight">Perbarui Akun Jualan</h2>@endsection

@section('content')
<div class="max-w-4xl mx-auto sm:px-6 lg:px-8 py-12">
    <div class="bg-gray-800 shadow-sm sm:rounded-lg">
        <form method="POST" action="{{ route('admin.market-accounts.update', $marketAccount) }}" class="p-6 md:p-8 space-y-6">
            @csrf
            @method('PUT')
            {{-- Game --}}
            <div>
                <label for="game_id" class="block mb-2 text-sm font-medium text-gray-300">Game</label>
                <select id="game_id" name="game_id" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @foreach($games as $game)<option value="{{ $game->id }}" @selected(old('game_id', $marketAccount->game_id) == $game->id)>{{ $game->name }}</option>@endforeach
                </select>
                @error('game_id') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>
            {{-- Judul --}}
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-300">Judul Penjualan</label>
                <input type="text" name="title" id="title" value="{{ old('title', $marketAccount->title) }}" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('title') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>
            {{-- Deskripsi --}}
            <div>
                <label for="description" class="block mb-2 text-sm font-medium text-gray-300">Deskripsi</label>
                <textarea id="description" name="description" rows="5" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ old('description', $marketAccount->description) }}</textarea>
                @error('description') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>
            {{-- Harga --}}
            <div>
                <label for="price" class="block mb-2 text-sm font-medium text-gray-300">Harga (Rp)</label>
                <input type="number" step="1000" name="price" id="price" value="{{ old('price', $marketAccount->price) }}" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('price') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>
            {{-- Status --}}
             <div>
                <label for="status" class="block mb-2 text-sm font-medium text-gray-300">Status</label>
                <select id="status" name="status" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="available" @selected($marketAccount->status == 'available')>Tersedia</option>
                    <option value="pending" @selected($marketAccount->status == 'pending')>Tertunda</option>
                    <option value="sold" @selected($marketAccount->status == 'sold')>Terjual</option>
                </select>
            </div>
            {{-- URL Gambar --}}
            <div>
                <label for="images" class="block mb-2 text-sm font-medium text-gray-300">URL Gambar (satu URL per baris)</label>
                {{-- Ubah array menjadi string untuk textarea --}}
                <textarea id="images" name="images" rows="4" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 font-mono">{{ old('images', implode("\n", $marketAccount->images ?? [])) }}</textarea>
                @error('images') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>
            {{-- Informasi Login --}}
            <div>
                <label for="login_details" class="block mb-2 text-sm font-medium text-gray-300">Informasi Login Akun</label>
                <textarea id="login_details" name="login_details" rows="4" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 font-mono">{{ old('login_details', $marketAccount->login_details) }}</textarea>
                <p class="mt-1 text-xs text-yellow-400">PERINGATAN: Informasi ini telah didekripsi untuk Anda. Menyimpannya akan mengenkripsinya kembali.</p>
                @error('login_details') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>
            <div class="flex justify-end gap-4">
                <a href="{{ route('admin.market-accounts.index') }}" class="text-sm font-medium text-gray-400 hover:text-white px-5 py-2.5 rounded-lg border border-gray-600 hover:bg-gray-700">Batal</a>
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 rounded-lg">Perbarui Akun</button>
            </div>
        </form>
    </div>
</div>
@endsection
