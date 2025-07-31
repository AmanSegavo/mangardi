@props([
    'type' => 'success', // Boleh jadi 'success' atau 'danger'
    'message' => ''
])

@php
    $baseClasses = 'p-4 rounded-lg mb-6 text-sm';
    $typeClasses = [
        'success' => 'bg-green-500/20 text-green-300',
        'danger' => 'bg-red-500/20 text-red-300',
    ];
@endphp

@if ($message)
<div {{ $attributes->merge(['class' => $baseClasses . ' ' . ($typeClasses[$type] ?? $typeClasses['success'])]) }} role="alert">
    {{ $message }}
</div>
@endif
