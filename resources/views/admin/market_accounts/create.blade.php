@extends('layouts.app')

@section('title', 'Tambah Akun Jualan Baru')

@section('header')
    <h2 class="font-semibold text-xl text-gray-200 leading-tight">
        Tambah Akun Baru untuk Dijual
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 shadow-xl sm:rounded-lg">
            <form method="POST" action="{{ route('admin.market-accounts.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="p-6 md:p-8 space-y-8">

                    {{-- Kelompok 1: Informasi Dasar Penjualan --}}
                    <fieldset class="space-y-6">
                        <legend class="text-lg font-semibold text-gray-100 mb-4 border-b border-gray-700 w-full pb-2">Informasi Dasar</legend>

                        <x-forms.select-group label="Pilih Game" name="game_id" :options="$games" required />

                        <x-forms.input-group label="Judul Penjualan" name="title" placeholder="cth: Akun MLBB Sultan Penuh Skin" required />

                        <x-forms.input-group label="Harga (Rp)" name="price" type="number" step="1000" placeholder="cth: 250000" required />
                    </fieldset>

                    {{-- Kelompok 2: Atribut Spesifik Akun --}}
                    <fieldset class="space-y-6">
                        <legend class="text-lg font-semibold text-gray-100 mb-4 border-b border-gray-700 w-full pb-2">Detail Spesifik Akun</legend>

                        {{-- Nama input menggunakan notasi array: attributes[nama_kunci] --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-forms.input-group label="Peringkat Saat Ini" name="attributes[rank]" />
                            <x-forms.input-group label="Jumlah Hero yang Dimiliki" name="attributes[total_heroes]" type="number" />
                            <x-forms.input-group label="Perkiraan Jumlah Skin" name="attributes[total_skins]" type="number" />
                        </div>
                        <x-forms.textarea-group label="Catatan Tambahan (cth: Emblem Max, Skin Legend)" name="attributes[catatan_tambahan]" :rows="3" />
                    </fieldset>

                    {{-- Kelompok 3: Galeri Gambar Akun (Dengan Pratinjau) --}}
                    <fieldset>
                        <legend class="text-lg font-semibold text-gray-100 mb-4 border-b border-gray-700 w-full pb-2">Galeri Gambar Akun</legend>
                        <div class="p-4 border border-dashed border-gray-600 rounded-lg">
                            <label for="images" class="block mb-2 text-sm font-medium text-gray-300">Pilih Gambar (Bisa pilih banyak)</label>
                            <input type="file" name="images[]" id="images" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-600/20 file:text-blue-300 hover:file:bg-blue-600/30 cursor-pointer"
                                   multiple required accept="image/jpeg,image/png,image/webp">
                            <p class="mt-1 text-xs text-gray-500">Pilih beberapa gambar sekaligus. Ukuran maks 2MB per gambar.</p>
                            @error('images.*') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror

                            {{-- Area Pratinjau Gambar --}}
                            <div id="image-preview-container" class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                {{-- Pratinjau akan dibuat oleh JavaScript di sini --}}
                            </div>
                        </div>
                    </fieldset>

                    {{-- Kelompok 4: Informasi Login (Rahasia) --}}
                    <fieldset>
                         <legend class="text-lg font-semibold text-gray-100 mb-4 border-b border-gray-700 w-full pb-2">Informasi Login (Rahasia)</legend>
                        <x-forms.textarea-group label="Email & Kata Sandi Akun" name="login_details" :rows="4" required class="font-mono" placeholder="Akan disimpan dengan aman dan hanya dapat diakses oleh pembeli." />
                    </fieldset>

                </div>

                {{-- Tombol Aksi --}}
                <div class="flex items-center justify-end gap-4 p-6 bg-gray-800/50 border-t border-gray-700 sm:rounded-b-lg">
                    <a href="{{ route('admin.market-accounts.index') }}" class="text-sm font-medium text-gray-400 hover:text-white">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 rounded-lg text-center transition-colors duration-200">
                        Simpan Akun
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('images');
    const previewContainer = document.getElementById('image-preview-container');

    // DataTransfer digunakan untuk mengelola daftar file yang dipilih, karena FileList asli bersifat read-only.
    let dataTransfer = new DataTransfer();

    imageInput.addEventListener('change', function(event) {
        // Tambah file baru ke dalam daftar DataTransfer
        Array.from(event.target.files).forEach(file => {
            dataTransfer.items.add(file);
        });

        // Perbarui input file dengan daftar terbaru
        imageInput.files = dataTransfer.files;

        // Kosongkan dan buat ulang pratinjau
        renderPreviews();
    });

    function renderPreviews() {
        previewContainer.innerHTML = ''; // Kosongkan pratinjau yang ada

        Array.from(dataTransfer.files).forEach((file, index) => {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Buat 'wrapper' untuk setiap gambar dan tombol hapus
                const previewWrapper = document.createElement('div');
                previewWrapper.className = 'relative aspect-square';

                // Buat elemen gambar
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'object-cover w-full h-full rounded-md';

                // Buat tombol hapus
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button'; // Hindari submit form
                removeBtn.innerHTML = '×'; // Simbol silang (X)
                removeBtn.className = 'absolute top-1 right-1 bg-red-600/80 hover:bg-red-700 text-white font-bold w-6 h-6 rounded-full flex items-center justify-center text-lg leading-none';

                removeBtn.onclick = function() {
                    removeFile(index);
                };

                previewWrapper.appendChild(img);
                previewWrapper.appendChild(removeBtn);
                previewContainer.appendChild(previewWrapper);
            }

            reader.readAsDataURL(file);
        });
    }

    function removeFile(index) {
        // Buat daftar file baru tanpa file yang ingin dihapus
        const newFiles = new DataTransfer();
        const oldFiles = Array.from(dataTransfer.files);

        oldFiles.forEach((file, i) => {
            if (i !== index) {
                newFiles.items.add(file);
            }
        });

        // Ganti daftar lama dengan daftar baru
        dataTransfer = newFiles;
        imageInput.files = dataTransfer.files; // Perbarui input file yang sebenarnya

        // Tampilkan ulang pratinjau
        renderPreviews();
    }
});
</script>
@endpush
