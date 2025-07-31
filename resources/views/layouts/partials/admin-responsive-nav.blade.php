<!--
    Fail ini hanya mengandungi pautan navigasi untuk ADMIN dalam mod MUDAH ALIH (Responsif).
    Akan dipanggil dari fail navigasi utama (contohnya, layouts/navigation.blade.php).
-->

<!-- Pemisah dan Tajuk untuk bahagian Admin -->
<div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
    <div class="px-4">
        <div class="font-medium text-base text-gray-800 dark:text-gray-200">Menu Admin</div>
    </div>

    <div class="mt-3 space-y-1">
        <!-- Pautan Dashboard -->
        <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
            {{ __('Admin Dashboard') }}
        </x-responsive-nav-link>

        <!-- Pautan Pengurusan -->
        <x-responsive-nav-link :href="route('admin.games.index')" :active="request()->routeIs('admin.games.*')">
            Urus Permainan
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('admin.diamond-topups.index')" :active="request()->routeIs('admin.diamond-topups.*')">
            Urus Pakej Top-up
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('admin.transactions.index')" :active="request()->routeIs('admin.transactions.*')">
            Urus Transaksi
        </x-responsive-nav-link>
    </div>
</div>
