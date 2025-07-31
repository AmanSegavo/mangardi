@props([
    'label',
    'name',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'readonly' => false,
    'required' => false,
])

{{--
    $attributes membolehkan anda menghantar sebarang atribut HTML (cth: class, id, data-*)
    terus ke div utama dari tempat komponen dipanggil.
--}}
<div {{ $attributes }}>
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-300">
        {{ $label }}
        {{-- Tambah asterisk merah jika medan ini diperlukan (required) --}}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $readonly ? 'readonly' : '' }}
        {{ $required ? 'required' : '' }}

        {{--
            Arahan @class menjadikan pengurusan kelas CSS bersyarat lebih kemas.
            Ia akan menggabungkan semua kelas ini secara automatik.
        --}}
        @class([
            'block w-full p-2.5 text-sm rounded-lg border',
            'bg-gray-700 border-gray-600 text-white focus:ring-blue-500 focus:border-blue-500',
            'bg-gray-900 text-gray-400 cursor-not-allowed' => $readonly,
            'border-red-500 focus:ring-red-500 focus:border-red-500' => $errors->has($name)
        ])
    >

    @error($name)
        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>
