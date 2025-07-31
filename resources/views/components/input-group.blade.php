@props([
    'label',
    'name',
    'type' => 'text',
    'value' => '',
    'readonly' => false,
    'class' => ''
])

<div class="{{ $class }}">
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-300">{{ $label }}</label>
    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        {{ $readonly ? 'readonly' : '' }}
        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @if($readonly) bg-gray-900 text-gray-400 cursor-not-allowed @endif @error($name) border-red-500 @enderror"
    >
    @error($name)
        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>
