@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-white bg-white/10 rounded-md focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-300 hover:text-white hover:bg-white/5 rounded-md focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
