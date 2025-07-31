@extends('layouts.app')

@section('title', $account->title)

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 shadow-xl rounded-lg overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-0">
                <!-- Bahagian Gambar -->
                <div class="md:col-span-3">
                    <img src="{{ $account->images[0] ?? 'https://via.placeholder.com/600' }}" alt="{{ $account->title }}" class="w-full h-full max-h-[500px] object-cover">
                </div>

                <!-- Bahagian Info dan Butang Beli -->
                <div class="md:col-span-2 p-6 md:p-8 flex flex-col">
                    <div class="flex-grow">
                        <span class="inline-block bg-purple-600 text-white text-sm font-bold px-3 py-1 rounded-full mb-3">{{ $account->game->name }}</span>
                        <h1 class="text-3xl font-bold text-white leading-tight">{{ $account->title }}</h1>

                        <p class="text-3xl font-bold text-purple-400 my-4">
                            RM {{ number_format($account->price, 2) }}
                        </p>

                        <h3 class="font-semibold text-white mt-6 mb-2 border-b border-gray-700 pb-2">Deskripsi Akaun:</h3>
                        <div class="text-gray-300 prose prose-invert max-w-none text-sm leading-relaxed">
                            {!! nl2br(e($account->description)) !!}
                        </div>
                    </div>

                    <div class="mt-8">
                        {{-- ==== UBAH BAHAGIAN INI ==== --}}
                        {{-- Daripada form, kita guna link ke halaman bayaran --}}
                        <a href="{{ route('marketplace.buy.form', $account) }}" class="block w-full text-center bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-6 rounded-lg transition duration-300 text-lg">
                            Beli Sekarang
                        </a>
                        {{-- ============================== --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
