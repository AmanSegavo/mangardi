@extends('layouts.app')

@section('title', 'Urus Pakej Top-up')

@section('header')
    <h2 class="font-semibold text-xl text-gray-200 leading-tight">
        {{ __('Urus Pakej Diamond Top-up') }}
    </h2>
@endsection

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Notifikasi Kejayaan --}}
        @if (session('success'))
            <div class="bg-green-500/20 text-green-300 p-4 rounded-lg mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-gray-800 shadow-sm sm:rounded-lg">
            {{-- Header Jadual dan Butang Tambah --}}
            <div class="p-6 flex justify-between items-center border-b border-gray-700">
                <h3 class="text-lg font-medium text-white">Senarai Pakej</h3>
                <a href="{{ route('admin.diamond-topups.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
                    Tambah Pakej Baru
                </a>
            </div>

            {{-- Jadual Data --}}
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-400">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-700/50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Game</th>
                            <th scope="col" class="px-6 py-3">Nama Pakej</th>
                            <th scope="col" class="px-6 py-3">Jumlah Diamond</th>
                            <th scope="col" class="px-6 py-3">Harga</th>
                            <th scope="col" class="px-6 py-3 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($topups as $topup)
                            <tr class="bg-gray-800 border-b border-gray-700 hover:bg-gray-700/50">
                                <td class="px-6 py-4 font-medium text-white">{{ $topup->game->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $topup->name }}</td>
                                <td class="px-6 py-4">{{ number_format($topup->amount) }}</td>
                                <td class="px-6 py-4">RM {{ number_format($topup->price, 2) }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('admin.diamond-topups.edit', $topup) }}" class="font-medium text-blue-400 hover:underline">Kemaskini</a>
                                        <form action="{{ route('admin.diamond-topups.destroy', $topup) }}" method="POST" onsubmit="return confirm('Anda pasti mahu padam item ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-400 hover:underline">Padam</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    Tiada pakej top-up ditemui.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginasi --}}
            <div class="p-4">
                {{ $topups->links() }}
            </div>
        </div>
    </div>
@endsection
