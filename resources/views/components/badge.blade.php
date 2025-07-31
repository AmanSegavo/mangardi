@props([
    'type' => 'info', // Boleh jadi 'success', 'warning', 'danger', 'info'
])

@php
    $baseClasses = 'px-2.5 py-0.5 rounded-full text-xs font-medium inline-block';
    $typeClasses = [
        'success' => 'bg-green-900 text-green-300',
        'warning' => 'bg-yellow-900 text-yellow-300',
        'danger'  => 'bg-red-900 text-red-300',
        'info'    => 'bg-blue-900 text-blue-300',
    ];
@endphp

<span {{ $attributes->merge(['class' => $baseClasses . ' ' . ($typeClasses[$type] ?? $typeClasses['info'])]) }}>
    {{ $slot }}
</span>
