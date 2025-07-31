<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File; // <-- Tambah ini untuk operasi fail

class GameController extends Controller
{
    public function index()
    {
        $games = Game::latest()->paginate(10);
        return view('admin.games.index', compact('games'));
    }

    public function create()
    {
        return view('admin.games.create');
    }

    /**
     * Simpan game baru dan muat naik gambar ke public/images.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:games,slug',
            'description' => 'nullable|string',
            'release_date' => 'nullable|date',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            // Bina nama fail unik untuk elak pertembungan nama
            $imageName = time() . '_' . $image->getClientOriginalName();
            // Pindahkan fail ke public/images
            $image->move(public_path('images'), $imageName);
            // Sediakan laluan (path) untuk disimpan ke pangkalan data
            $imagePath = '/images/' . $imageName;
        }

        Game::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'release_date' => $data['release_date'],
            'image_url' => $imagePath, // Simpan path baru
        ]);

        return redirect()->route('admin.games.index')
                         ->with('success', 'Permainan berjaya ditambah.');
    }

    public function edit(Game $game)
    {
        return view('admin.games.edit', compact('game'));
    }

    /**
     * Kemaskini game dan kendalikan muat naik gambar baru.
     */
    public function update(Request $request, Game $game)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => ['required','string', Rule::unique('games')->ignore($game->id)],
            'description' => 'nullable|string',
            'release_date' => 'nullable|date',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = $game->image_url; // Kekalkan gambar lama secara lalai

        if ($request->hasFile('image_url')) {
            // 1. Padam gambar lama dari public/images jika ada
            if ($game->image_url && File::exists(public_path($game->image_url))) {
                File::delete(public_path($game->image_url));
            }

            // 2. Muat naik dan simpan gambar baru
            $image = $request->file('image_url');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $imagePath = '/images/' . $imageName;
        }

        // Kemaskini data dengan path gambar yang baru (atau yang lama jika tiada perubahan)
        $data['image_url'] = $imagePath;
        $game->update($data);

        return redirect()->route('admin.games.index')
                         ->with('success', 'Permainan berjaya dikemaskini.');
    }

    /**
     * Padam game DAN fail gambar yang berkaitan dari public/images.
     */
    public function destroy(Game $game)
    {
        // Padam gambar dari storan sebelum padam rekod dari DB
        if ($game->image_url && File::exists(public_path($game->image_url))) {
            File::delete(public_path($game->image_url));
        }

        $game->delete();

        return redirect()->route('admin.games.index')
                         ->with('success', 'Permainan berjaya dipadam.');
    }
}
