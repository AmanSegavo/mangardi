@extends('layouts.app')

@section('title', 'Pasar Akun')

@section('header')
    <h2 class="font-semibold text-xl text-gray-200 leading-tight">
        Pasar Akun Game
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($accounts as $account)
                <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden group transition-all duration-300 hover:shadow-purple-500/20 hover:-translate-y-1">
                    <a href="{{ route('marketplace.show', $account) }}">
                        <div class="relative">
                            {{-- Tampilkan gambar pertama dari daftar gambar --}}
                            <img class="w-full h-48 object-cover"
                                 src="{{ $account->images[0] ?? 'https://via.placeholder.com/300' }}"
                                 alt="{{ $account->title }}">
                            <div class="absolute top-2 left-2 bg-purple-600 text-white text-xs font-bold px-2 py-1 rounded">
                                {{ $account->game->name }}
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-white truncate group-hover:text-purple-300 transition-colors">{{ $account->title }}</h3>
                            <p class="text-lg font-bold text-purple-400 mt-2">Rp {{ number_format($account->price, 2, ',', '.') }}</p>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                     <p class="text-gray-400">Tidak ada akun yang dijual saat ini.</p>
                </div>
            @endforelse
        </div>

        {{-- Paginasi --}}
        <div class="mt-8">
            {{ $accounts->links() }}
        </div>
    </div>
</div>
@endsection
