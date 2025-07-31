@csrf
<div class="space-y-4">
    <!-- Game Selection -->
    <div>
        <label for="game_id" class="block text-sm font-medium text-gray-300">Pilih Permainan</label>
        <select name="game_id" id="game_id" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            @foreach($games as $game)
                <option value="{{ $game->id }}" {{ old('game_id', $diamondTopup->game_id ?? '') == $game->id ? 'selected' : '' }}>
                    {{ $game->name }}
                </option>
            @endforeach
        </select>
        @error('game_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Package Name -->
    <div>
        <label for="name" class="block text-sm font-medium text-gray-300">Nama Pakej</label>
        <input type="text" name="name" id="name" value="{{ old('name', $diamondTopup->name ?? '') }}" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-purple-500 focus:border-purple-500 sm:text-sm" placeholder="cth: 100 Diamonds + 10 Bonus">
        @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Amount -->
    <div>
        <label for="amount" class="block text-sm font-medium text-gray-300">Jumlah (Contoh: 100)</label>
        <input type="number" name="amount" id="amount" value="{{ old('amount', $diamondTopup->amount ?? '') }}" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
        @error('amount') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Price -->
    <div>
        <label for="price" class="block text-sm font-medium text-gray-300">Harga (RM)</label>
        <input type="text" name="price" id="price" value="{{ old('price', $diamondTopup->price ?? '') }}" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-purple-500 focus:border-purple-500 sm:text-sm" placeholder="cth: 4.50">
        @error('price') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Submit Button -->
    <div>
        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
            {{ $buttonText ?? 'Simpan' }}
        </button>
    </div>
</div>
