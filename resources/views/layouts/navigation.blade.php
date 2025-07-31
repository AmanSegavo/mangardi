@php
// Logika untuk menentukan apakah link dropdown admin harus aktif
$isAdminManagementActive = request()->routeIs([
    'admin.games.*',
    'admin.diamond-topups.*',
    'admin.market-accounts.*',
    'admin.transactions.*'
]);
@endphp

{{--
    Navbar dengan efek "Sticky Glass"
    - sticky: Tetap di atas saat menggulir
    - top-0: Posisi di paling atas
    - z-50: Tampil di atas semua elemen lain
    - bg-black/50 backdrop-blur-lg: Latar belakang semi-transparan dengan efek blur
    - border-b border-white/10: Garis bawah tipis sebagai pemisah
--}}
<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-black/50 backdrop-blur-lg border-b border-white/10 shadow-lg">
    <!-- Menu Navigasi Utama -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo dengan Efek Gradien -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ Auth::check() ? route('dashboard') : route('welcome') }}"
                       class="text-2xl font-black tracking-wider bg-gradient-to-r from-purple-400 via-pink-500 to-orange-400 bg-clip-text text-transparent hover:opacity-80 transition-opacity">
                        MANGARDI
                    </a>
                </div>

                <!-- Tautan Navigasi Desktop -->
                <div class="hidden space-x-1 sm:ml-10 sm:flex">
                    @auth
                        @if (Auth::user()->role === 'admin')
                            <!-- ====== NAVIGASI ADMIN ====== -->
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                {{ __('Dasbor Admin') }}
                            </x-nav-link>

                            <!-- Dropdown Manajemen (Cerdas & Bergaya) -->
                            <div class="flex items-center ml-4">
                                <x-dropdown align="left" width="56">
                                    <x-slot name="trigger">
                                        {{-- Tombol ini sekarang akan 'aktif' jika salah satu submenu-nya aktif --}}
                                        <button @class([
                                            'inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md transition duration-150 ease-in-out focus:outline-none',
                                            'bg-white/10 text-white' => $isAdminManagementActive,
                                            'text-gray-300 hover:bg-white/5 hover:text-white' => !$isAdminManagementActive,
                                        ])>
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            <div>Manajemen</div>
                                            <div class="ml-1"><svg class="fill-current h-4 w-4" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" /></svg></div>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <div class="p-2 bg-gray-800/90 backdrop-blur-md rounded-md border border-white/10 shadow-lg">
                                            <x-dropdown-link :href="route('admin.games.index')">Kelola Game</x-dropdown-link>
                                            <x-dropdown-link :href="route('admin.diamond-topups.index')">Kelola Paket Top-up</x-dropdown-link>
                                            <x-dropdown-link :href="route('admin.market-accounts.index')">Kelola Akun Jualan</x-dropdown-link>
                                            <x-dropdown-link :href="route('admin.transactions.index')">Kelola Transaksi</x-dropdown-link>
                                        </div>
                                    </x-slot>
                                </x-dropdown>
                            </div>

                        @else
                            <!-- ====== NAVIGASI PENGGUNA BIASA ====== -->
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Dasbor') }}
                            </x-nav-link>
                            <x-nav-link :href="route('marketplace.index')" :active="request()->routeIs('marketplace.*')">
                                {{ __('Pasar Akun') }}
                            </x-nav-link>
                            <x-nav-link :href="route('transactions.index')" :active="request()->routeIs('transactions.*')">
                                {{ __('Riwayat Transaksi') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Bagian Kanan: Profil atau Masuk/Daftar -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <!-- Dropdown Profil Pengguna -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center space-x-2 text-sm font-medium text-gray-300 hover:text-white transition group">
                                <span class="hidden md:inline">{{ Auth::user()->name }}</span>
                                <img class="h-10 w-10 rounded-full object-cover ring-2 ring-white/10 group-hover:ring-purple-400 transition" src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=78716C&color=fff' }}" alt="Avatar">
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="p-2 bg-gray-800/90 backdrop-blur-md rounded-md border border-white/10 shadow-lg">
                                <div class="px-2 py-2 border-b border-white/10">
                                    <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="pt-1">
                                    <x-dropdown-link :href="route('profile.edit')">Profil Saya</x-dropdown-link>
                                    <form method="POST" action="{{ route('logout') }}">@csrf<x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Keluar') }}</x-dropdown-link></form>
                                </div>
                            </div>
                        </x-slot>
                    </x-dropdown>
                @else
                    <!-- Tombol Masuk & Daftar untuk Tamu -->
                    <div class="space-x-3">
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-white bg-white/5 rounded-md hover:bg-white/10 transition">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-md hover:bg-purple-700 transition">
                            Daftar Sekarang
                        </a>
                        @endif
                    </div>
                @endauth
            </div>

            <!-- Tombol Hamburger (Menu Mobile) -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-300 hover:text-white hover:bg-white/10 focus:outline-none focus:bg-white/10 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu Navigasi Responsif (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden border-t border-white/10 bg-black/30 backdrop-blur-xl">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if (Auth::user()->role === 'admin')
                    <!-- Panggil partial admin mobile -->
                    @include('layouts.partials.admin-responsive-nav')
                @else
                    <!-- Tautan untuk pengguna biasa -->
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dasbor</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('marketplace.index')" :active="request()->routeIs('marketplace.*')">Pasar Akun</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('transactions.index')" :active="request()->routeIs('transactions.*')">Riwayat Transaksi</x-responsive-nav-link>
                @endif
            @else
                <!-- Tautan untuk tamu -->
                <x-responsive-nav-link :href="route('login')">Masuk</x-responsive-nav-link>
                @if (Route::has('register'))<x-responsive-nav-link :href="route('register')">Daftar</x-responsive-nav-link>@endif
            @endauth
        </div>

        @auth
        <!-- Opsi pengguna di menu mobile -->
        <div class="pt-4 pb-1 border-t border-white/10">
            <div class="flex items-center px-4">
                 <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=78716C&color=fff' }}" alt="Avatar">
                <div class="ml-3">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">Profil Saya</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">@csrf<x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">{{ __('Keluar') }}</x-responsive-nav-link></form>
            </div>
        </div>
        @endauth
    </div>
</nav>
