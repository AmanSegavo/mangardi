@props(['title'])

<div {{ $attributes->merge(['class' => 'text-center']) }}>
    <h2 class="text-4xl font-bold text-white mb-2">{{ $title }}</h2>
    <div class="w-24 h-1 bg-purple-500 mx-auto mb-12 rounded"></div>
</div>
