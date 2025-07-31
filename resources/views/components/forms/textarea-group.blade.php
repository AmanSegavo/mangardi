@props([
    'label',
    'name',
    'rows' => 4,
    'value' => ''
])

<div>
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-300">{{ $label }}</label>
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error($name) border-red-500 @enderror"
    >{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>
