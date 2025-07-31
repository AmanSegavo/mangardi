@extends('layouts.app')

@section('title', 'Pengaturan Profil')

@section('header')
    {{ __('Pengaturan Akun') }}
@endsection

@section('content')
    {{-- Menggunakan space-y-8 untuk memberi jarak yang konsisten antar panel --}}
    <div class="space-y-8">
        {{-- Panel Informasi Profil --}}
        <div class="p-6 sm:p-8 bg-black/50 backdrop-blur-xl shadow-2xl shadow-black/30 overflow-hidden rounded-2xl ring-1 ring-white/10">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        {{-- Panel Perbarui Kata Sandi --}}
        <div class="p-6 sm:p-8 bg-black/50 backdrop-blur-xl shadow-2xl shadow-black/30 overflow-hidden rounded-2xl ring-1 ring-white/10">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        {{-- Panel Hapus Akun (Zona Berbahaya) --}}
        <div class="p-6 sm:p-8 bg-red-900/20 backdrop-blur-xl shadow-2xl shadow-black/30 overflow-hidden rounded-2xl ring-1 ring-red-500/30">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
