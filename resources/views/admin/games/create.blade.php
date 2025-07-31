@extends('layouts.app')

@section('title', 'Tambah Permainan Baru')

@section('header')
    <h2 class="font-semibold text-xl text-gray-200 leading-tight">
        {{ __('Tambah Permainan Baru') }}
    </h2>
@endsection

@section('content')
<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-gray-800 shadow-sm sm:rounded-lg">
        <div class="p-6 md:p-8">
            <form method="POST" action="{{ route('admin.games.store') }}">
                @csrf
                <div class="space-y-6">

                    {{-- Nama & Slug --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-300">Nama Permainan</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="cth: Mobile Legends: Bang Bang" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @error('name') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="slug" class="block mb-2 text-sm font-medium text-gray-300">Slug (URL)</label>
                            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" placeholder="dijana secara automatik" class="bg-gray-900 border border-gray-600 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                             @error('slug') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-300">Deskripsi</label>
                        <textarea id="description" name="description" rows="4" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Tulis sedikit tentang game ini...">{{ old('description') }}</textarea>
                        @error('description') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>



                    {{-- Tarikh Terbit & URL Gambar --}}
                     <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="release_date" class="block mb-2 text-sm font-medium text-gray-300">Tarikh Terbit</label>
                            <input type="date" name="release_date" id="release_date" value="{{ old('release_date') }}" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @error('release_date') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="image_url" class="block mb-2 text-sm font-medium text-gray-300">URL Gambar</label>
                            <input type="url" name="image_url" id="image_url" value="{{ old('image_url') }}" placeholder="https://..." class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @error('image_url') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Butang Tindakan --}}
                <div class="flex items-center justify-end mt-8">
                    <a href="{{ route('admin.games.index') }}" class="text-sm text-gray-400 hover:text-white mr-4">
                        Batal
                    </a>
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 rounded-lg text-center">
                        Simpan Permainan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const nameInput = document.querySelector('#name');
    const slugInput = document.querySelector('#slug');

    nameInput.addEventListener('keyup', function() {
        const slug = this.value.toString().toLowerCase()
            .replace(/\s+/g, '-')           // Ganti spaces dengan -
            .replace(/[^\w\-]+/g, '')       // Buang semua karakter bukan perkataan
            .replace(/\-\-+/g, '-')         // Ganti beberapa - dengan satu -
            .replace(/^-+/, '')             // Potong - dari permulaan teks
            .replace(/-+$/, '');            // Potong - dari penghujung teks
        slugInput.value = slug;
    });
</script>
@endsection
