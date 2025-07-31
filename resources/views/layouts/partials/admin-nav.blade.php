<!-- Responsive Navigation Menu -->
<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>
    </div>

    <!-- Pilihan Pengguna Responsif -->
    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
        <!-- ... kod untuk menu pengguna ... -->
    </div>

    <!-- ===== Mula Bahagian Admin ===== -->
    @if(auth()->user()->isAdmin())  {{-- Contoh semakan jika pengguna adalah admin --}}
        @include('layouts.admin-responsive-nav')
    @endif
    <!-- ===== Tamat Bahagian Admin ===== -->

</div>
