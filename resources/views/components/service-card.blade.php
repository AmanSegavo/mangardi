@props([
    'image',
    'title',
    'route',
    'theme' => 'purple',
])

@php
    $themeClasses = [
        'purple' => [
            'shadow' => 'hover:shadow-purple-500/40',
            'icon' => 'text-purple-400',
            'button_bg' => 'bg-purple-600',
            'button_hover' => 'group-hover:bg-pink-600',
        ],
        'blue' => [
            'shadow' => 'hover:shadow-blue-500/40',
            'icon' => 'text-blue-400',
            'button_bg' => 'bg-blue-600',
            'button_hover' => 'group-hover:bg-sky-500',
        ],
        'green' => [
            'shadow' => 'hover:shadow-green-500/40',
            'icon' => 'text-green-400',
            'button_bg' => 'bg-green-600',
            'button_hover' => 'group-hover:bg-emerald-500',
        ],
    ];
    $currentTheme = $themeClasses[$theme] ?? $themeClasses['purple'];
@endphp

<div
    class="relative rounded-lg overflow-hidden group hover:shadow-2xl {{ $currentTheme['shadow'] }} transition-shadow duration-300 aspect-[4/3]"
    style="background-image: url('{{ $image }}'); background-size: cover; background-position: center;">

    <!-- Overlay gelap -->
    <div class="absolute inset-0 bg-black bg-opacity-50 group-hover:bg-opacity-60 transition duration-300"></div>

    <!-- Konten -->
    <div class="relative z-10 p-6 flex flex-col justify-between h-full text-white">
        <div>
            @isset($icon)
                <div class="w-8 h-8 mb-3 {{ $currentTheme['icon'] }}">
                    {{ $icon }}
                </div>
            @endisset

            <h3 class="text-2xl font-bold mb-2">{{ $title }}</h3>
            <p class="text-sm text-gray-200">{{ $slot }}</p>
        </div>

        <div class="mt-6 text-right">
            @if ($route && Route::has($route))
                <a href="{{ route($route) }}"
                   class="inline-flex items-center {{ $currentTheme['button_bg'] }} hover:bg-opacity-80 {{ $currentTheme['button_hover'] }} text-white font-semibold py-2 px-6 rounded-md transition duration-300">
                    Jelajahi
                    <span class="ml-2 transform group-hover:translate-x-1 transition-transform">→</span>
                </a>
            @else
                <span class="text-sm italic text-gray-300">tersedia</span>
            @endif
        </div>
    </div>
</div>
