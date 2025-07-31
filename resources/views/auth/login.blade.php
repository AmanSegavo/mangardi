@extends('layouts.guest')

@section('title', 'Masuk ke Akun Anda')

@section('content')

    {{-- Kartu Form dengan Efek "Glass" --}}
    <div class="w-full max-w-md px-6 py-8 bg-black/50 backdrop-blur-xl shadow-2xl shadow-black/30 overflow-hidden rounded-2xl ring-1 ring-white/10">

        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-white">Selamat Datang Kembali</h1>
            <p class="text-gray-400 text-sm mt-1">Silakan masuk untuk melanjutkan petualanganmu.</p>
        </div>

        <!-- Notifikasi Session (jika ada) -->
        <x-auth-session-status class="mb-4 text-green-400 bg-green-500/10 p-3 rounded-md text-sm border border-green-500/30" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Input Email -->
            <div class="space-y-2">
                <x-input-label for="email" value="Alamat Email" class="text-gray-300" />
                <x-text-input
                    id="email"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="contoh@email.com"
                    class="block w-full bg-white/5 border-white/10 text-white placeholder-gray-500 focus:ring-purple-500 focus:border-purple-500"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Input Kata Sandi -->
            <div class="space-y-2">
                <x-input-label for="password" value="Kata Sandi" class="text-gray-300" />
                <x-text-input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••••"
                    class="block w-full bg-white/5 border-white/10 text-white placeholder-gray-500 focus:ring-purple-500 focus:border-purple-500"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- "Ingat Saya" & "Lupa Kata Sandi" -->
            <div class="flex items-center justify-between text-sm">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded bg-gray-900 border-gray-600 text-purple-600 shadow-sm focus:ring-purple-500 focus:ring-offset-gray-900" name="remember">
                    <span class="ms-2 text-gray-400">Ingat Saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="underline text-purple-400 hover:text-purple-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900" href="{{ route('password.request') }}">
                        Lupa kata sandi?
                    </a>
                @endif
            </div>

            <!-- Tombol Masuk Utama -->
            <div>
                <x-primary-button class="w-full flex justify-center py-3 text-base bg-purple-600 hover:bg-purple-700 active:bg-purple-800 focus:bg-purple-700">
                    Masuk ke Akun
                </x-primary-button>
            </div>
        </form>

        <!-- Tautan ke Halaman Daftar -->
        <p class="text-center mt-8 text-sm text-gray-400">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-medium text-purple-400 hover:text-purple-300 underline">
                Buat Akun Sekarang
            </a>
        </p>
    </div>

@endsection
