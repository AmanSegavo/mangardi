@props(['title'])

<div class="bg-gray-800 p-6 rounded-lg text-center">
    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-purple-500/20 mx-auto mb-4">
        {{ $icon }}
    </div>
    <h3 class="text-xl font-bold text-white">{{ $title }}</h3>
    <p class="text-gray-400 mt-2">{{ $slot }}</p>
</div>
