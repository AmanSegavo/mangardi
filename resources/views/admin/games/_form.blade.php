@csrf
<div class="space-y-4">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-300">Nama Permainan</label>
        <input type="text" name="name" id="name" value="{{ old('name', $game->name ?? '') }}" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
        @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="slug" class="block text-sm font-medium text-gray-300">Slug (URL)</label>
        <input type="text" name="slug" id="slug" value="{{ old('slug', $game->slug ?? '') }}" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
        @error('slug') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>
     <div>
        <label for="developer" class="block text-sm font-medium text-gray-300">Pembangun (Developer)</label>
        <input type="text" name="developer" id="developer" value="{{ old('developer', $game->developer ?? '') }}" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
        @error('developer') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="publisher" class="block text-sm font-medium text-gray-300">Penerbit (Publisher)</label>
        <input type="text" name="publisher" id="publisher" value="{{ old('publisher', $game->publisher ?? '') }}" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
        @error('publisher') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="image_url" class="block text-sm font-medium text-gray-300">URL Gambar</label>
        <input type="url" name="image_url" id="image_url" value="{{ old('image_url', $game->image_url ?? '') }}" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
        @error('image_url') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>
    <div>
        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
            {{ $buttonText ?? 'Simpan' }}
        </button>
    </div>
</div>
