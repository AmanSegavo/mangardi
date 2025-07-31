<section>
    <header class="border-b border-white/10 pb-4">
        <h2 class="text-xl font-bold text-white">
            Informasi Profil
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            Perbarui informasi profil dan alamat email akun Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Nama Lengkap -->
        <div class="space-y-2">
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" name="name" type="text" class="block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Alamat Email -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-400">
                        {{ __('Alamat email Anda belum terverifikasi.') }}

                        <button form="send-verification" class="underline text-sm text-purple-400 hover:text-purple-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>

            <Transition
                enter-from-class="opacity-0"
                leave-to-class="opacity-0"
                class="transition ease-in-out duration-300"
            >
                <p x-data="{ show: false }" x-show="show" x-init="setTimeout(() => show = true, 2000)" class="text-sm text-gray-400">{{ __('Tersimpan.') }}</p>
            </Transition>
        </div>
    </form>
</section>

{{-- Beri gaya pada Text Input agar sesuai dengan tema kaca --}}
@push('styles')
<style>
    .dark .dark\:bg-gray-900 {
        background-color: rgb(255 255 255 / 0.05) !important;
        border-color: rgb(255 255 255 / 0.1) !important;
    }
    .dark .dark\:focus\:border-purple-500:focus {
        --tw-ring-color: #a855f7 !important;
        border-color: #a855f7 !important;
    }
</style>
@endpush
