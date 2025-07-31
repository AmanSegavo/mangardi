@extends('layouts.app')

@section('title', 'Kemaskini Permainan')

@section('header')
    <h2 class="font-semibold text-xl text-gray-200 leading-tight">
        {{ __('Kemaskini Permainan: ') }} <span class="text-blue-400 font-bold">{{ $game->name }}</span>
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 shadow-xl sm:rounded-lg">
            <div class="p-6 md:p-8">

                <form method="POST" action="{{ route('admin.games.update', $game) }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    {{-- Bahagian Maklumat Asas --}}
                    <fieldset>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Nama Permainan --}}
                            <x-forms.input-group label="Nama Permainan" name="name" :value="$game->name" />

                            {{-- Slug (Read-only) --}}
                            <x-forms.input-group label="Slug (URL)" name="slug" :value="$game->slug" :readonly="true" />
                        </div>
                    </fieldset>

                    {{-- Bahagian Deskripsi & Tarikh --}}
                    <fieldset class="space-y-6">
                        {{-- Deskripsi --}}
                        <x-forms.textarea-group label="Deskripsi" name="description" :value="$game->description" />

                        {{-- Tarikh Terbit --}}
                        <x-forms.input-group label="Tarikh Terbit" name="release_date" type="date" :value="$game->release_date" />
                    </fieldset>

                    {{-- Bahagian Muat Naik Gambar (Dengan Pratonton) --}}
                    <fieldset>
                        <label class="block mb-2 text-sm font-medium text-gray-300">Gambar Permainan</label>
                        <div class="mt-2 flex items-center gap-x-6 p-4 border border-dashed border-gray-600 rounded-lg">
                            {{-- Pratonton Imej --}}
                            <img id="image-preview"
                                 src="{{ $game->image_url ? asset($game->image_url) : 'https://via.placeholder.com/96/1F2937/FFFFFF?text=Tiada+Imej' }}"
                                 alt="Pratonton Imej"
                                 class="h-24 w-24 object-cover rounded-md bg-gray-700">

                            <div class="flex-grow">
                                <input type="file" name="image_url" id="image_url" accept="image/*" class="block w-full text-sm text-gray-400
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-600/20 file:text-blue-300
                                    hover:file:bg-blue-600/30 cursor-pointer">
                                <p class="mt-2 text-xs text-gray-500">
                                    Tinggalkan kosong jika tidak mahu menukar gambar. Format: JPG, PNG, WEBP.
                                </p>
                                @error('image_url')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </fieldset>

                    {{-- Butang Tindakan --}}
                    <div class="flex items-center justify-end pt-6 border-t border-gray-700">
                        <a href="{{ route('admin.games.index') }}" class="text-sm font-medium text-gray-400 hover:text-white mr-6">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 rounded-lg text-center transition-colors duration-200">
                            Kemaskini Permainan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

{{-- Skrip untuk slug dan pratonton imej --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.querySelector('#name');
        const slugInput = document.querySelector('#slug');
        const imageInput = document.querySelector('#image_url');
        const imagePreview = document.querySelector('#image-preview');

        // Penjana Slug Automatik
        if (nameInput && slugInput) {
            nameInput.addEventListener('keyup', function() {
                const slug = this.value.toString().toLowerCase()
                    .replace(/\s+/g, '-')           // Ganti ruang dengan -
                    .replace(/[^\w\-]+/g, '')       // Buang semua aksara bukan perkataan
                    .replace(/\-\-+/g, '-')         // Ganti -- berganda dengan satu -
                    .replace(/^-+/, '')             // Potong - dari permulaan teks
                    .replace(/-+$/, '');            // Potong - dari penghujung teks
                slugInput.value = slug;
            });
        }

        // Pratonton Imej
        if (imageInput && imagePreview) {
            imageInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    // Cipta URL sementara untuk fail yang dipilih dan paparkan di pratonton
                    imagePreview.src = URL.createObjectURL(file);
                }
            });
        }
    });
</script>
@endpush
