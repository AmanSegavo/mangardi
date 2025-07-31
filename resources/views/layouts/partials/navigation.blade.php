<!-- Pautan Navigasi Desktop Admin dengan Ikon -->

<!-- Menggunakan komponen baru untuk Admin Dashboard -->
<x-icon-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" icon="admin-dashboard">
    {{ __('Dasbor Admin') }}
</x-icon-nav-link>

<!-- Dropdown untuk Pengurusan Admin dengan Ikon -->
<div class="hidden sm:flex sm:items-center sm:ml-6">
    @php
        $isManagementActive = request()->routeIs(['admin.games.*', 'admin.diamond-topups.*', 'admin.transactions.*']);
    @endphp
    <x-dropdown align="left" width="48">
        <x-slot name="trigger">
            {{-- Gaya trigger ini dibuat agar mirip dengan nav-link --}}
            <button class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out
                @if ($isManagementActive)
                border-indigo-400 dark:border-indigo-600 text-gray-900 dark:text-gray-100 focus:border-indigo-700
                @else
                border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700
                @endif">
                <!-- Ikon Pengurusan (Heroicons - cog-6-tooth) -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0 0 15 0m-15 0a7.5 7.5 0 1 1 15 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.07A7.5 7.5 0 0 1 12 4.5v.75m0 13.5v.75m0-15A7.5 7.5 0 0 1 12 3v.75m0 15.5v.75m0-1.5A7.5 7.5 0 0 0 12 6v.75m0 9.75v.75" />
                </svg>

                <div>Pengurusan</div>
                <div class="ml-1"><svg class="fill-current h-4 w-4" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></div>
            </button>
        </x-slot>
        <x-slot name="content">
            <x-dropdown-link :href="route('admin.games.index')">Urus Permainan</x-dropdown-link>
            <x-dropdown-link :href="route('admin.diamond-topups.index')">Urus Paket Top-up</x-dropdown-link>
            <x-dropdown-link :href="route('admin.transactions.index')">Urus Transaksi</x-dropdown-link>
        </x-slot>
    </x-dropdown>
</div>
