@extends('layouts.app')

@section('title', 'Urus Permainan')

@section('header')
    <h2 class="font-semibold text-xl text-gray-200 leading-tight">
        {{ __('Urus Permainan (Games)') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Notifikasi Kejayaan --}}
            @if (session('success'))
                <div class="bg-green-600/30 border border-green-500 text-green-300 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
                    <strong class="font-bold">Berjaya!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-gray-800 shadow-xl sm:rounded-lg overflow-hidden">
                {{-- Header Jadual dan Butang Tambah --}}
                <div class="px-6 py-5 flex justify-between items-center bg-gray-900/50 border-b border-gray-700">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-white">Senarai Permainan</h3>
                        <p class="mt-1 text-sm text-gray-400">Urus koleksi permainan yang dipaparkan dalam sistem.</p>
                    </div>
                    <a href="{{ route('admin.games.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500 active:bg-indigo-700 disabled:opacity-50 transition-all duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        <span>Tambah Game</span>
                    </a>
                </div>

                {{-- Jadual Data --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-700/50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Gambar</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Nama Permainan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Slug</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Tarikh Terbit</th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Tindakan</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            @forelse ($games as $game)
                                <tr class="hover:bg-gray-700/50 transition-colors duration-150 ease-in-out">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img src="{{ $game->image_url ?? 'https://via.placeholder.com/128' }}" alt="Gambar {{ $game->name }}" class="h-14 w-14 object-cover rounded-lg shadow-lg">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-white">{{ $game->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-600/50 text-gray-300 font-mono">{{ $game->slug }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                        {{ $game->release_date ? \Carbon\Carbon::parse($game->release_date)->format('d M Y') : 'Tidak Dinyatakan' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end gap-x-4">
                                            <a href="{{ route('admin.games.edit', $game) }}" class="text-indigo-400 hover:text-indigo-300 transition-colors">Kemaskini</a>
                                            <form action="{{ route('admin.games.destroy', $game) }}" method="POST" onsubmit="return confirm('Anda pasti mahu padam game ini? Tindakan ini tidak boleh diundur.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-400 transition-colors">Padam</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p class="mt-4 text-lg text-gray-400">Tiada Data Ditemui</p>
                                            <p class="mt-1 text-sm text-gray-500">Cuba tambah permainan baharu untuk bermula.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Paginasi --}}
                @if ($games->hasPages())
                    <div class="p-4 bg-gray-900/50 border-t border-gray-700">
                        {{ $games->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
