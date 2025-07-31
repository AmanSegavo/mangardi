@extends('layouts.guest')

@section('title', 'Buat Akun Baru')

@section('content')

    {{-- Kartu Form dengan Efek "Glass" --}}
    <div class="w-full max-w-md px-6 py-8 bg-black/50 backdrop-blur-xl shadow-2xl shadow-black/30 overflow-hidden rounded-2xl ring-1 ring-white/10">

        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-white">Mulai Petualanganmu</h1>
            <p class="text-gray-400 text-sm mt-1">Daftar sekarang untuk mengakses semua fitur eksklusif.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Input Nama Lengkap -->
            <div class="space-y-2">
                <x-input-label for="name" value="Nama Lengkap Anda" class="text-gray-300" />
                <x-text-input
                    id="name"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Masukkan nama lengkapmu"
                    class="block w-full bg-white/5 border-white/10 text-white placeholder-gray-500 focus:ring-purple-500 focus:border-purple-500"
                />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Input Email -->
            <div class="space-y-2">
                <x-input-label for="email" value="Alamat Email" class="text-gray-300" />
                <x-text-input
                    id="email"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autocomplete="username"
                    placeholder="contoh@email.com"
                    class="block w-full bg-white/5 border-white/10 text-white placeholder-gray-500 focus:ring-purple-500 focus:border-purple-500"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Input Kata Sandi -->
            <div class="space-y-2">
                <x-input-label for="password" value="Buat Kata Sandi" class="text-gray-300" />
                <x-text-input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="•••••••••• (minimal 8 karakter)"
                    class="block w-full bg-white/5 border-white/10 text-white placeholder-gray-500 focus:ring-purple-500 focus:border-purple-500"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Input Konfirmasi Kata Sandi -->
            <div class="space-y-2">
                <x-input-label for="password_confirmation" value="Ulangi Kata Sandi" class="text-gray-300" />
                <x-text-input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••••"
                    class="block w-full bg-white/5 border-white/10 text-white placeholder-gray-500 focus:ring-purple-500 focus:border-purple-500"
                />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Tombol Daftar Utama -->
            <div>
                <x-primary-button class="w-full flex justify-center py-3 text-base bg-purple-600 hover:bg-purple-700 active:bg-purple-800 focus:bg-purple-700">
                    Buat Akun
                </x-primary-button>
            </div>
        </form>

        <!-- Tautan ke Halaman Masuk -->
        <p class="text-center mt-8 text-sm text-gray-400">
            Sudah terdaftar?
            <a href="{{ route('login') }}" class="font-medium text-purple-400 hover:text-purple-300 underline">
                Masuk di sini
            </a>
        </p>
    </div>

@endsection
