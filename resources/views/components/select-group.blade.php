@props([
    'label',
    'name',
    'options', // Hantar koleksi atau array ke sini
    'valueField' => 'id',
    'textField' => 'name',
    'placeholder' => 'Pilih satu...',
])

<div>
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-300">{{ $label }}</label>
    <select
        id="{{ $name }}"
        name="{{ $name }}"
        {{ $attributes->merge(['class' => 'bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5']) }}
    >
        <option value="" selected disabled>{{ $placeholder }}</option>
        @foreach($options as $option)
            <option
                value="{{ $option->{$valueField} }}"
                {{ old($name) == $option->{$valueField} ? 'selected' : '' }}
            >
                {{ $option->{$textField} }}
            </option>
        @endforeach
    </select>
    @error($name)
        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>
