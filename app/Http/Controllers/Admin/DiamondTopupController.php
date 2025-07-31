<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiamondTopup;
use App\Models\Game;
use Illuminate\Http\Request;

class DiamondTopupController extends Controller
{
    public function index()
    {
        $topups = DiamondTopup::with('game')->latest()->paginate(10);
        return view('admin.diamond_topups.index', compact('topups'));
    }

    public function create()
    {
        // Amalan terbaik: Ambil hanya data yang diperlukan
        $games = Game::orderBy('name')->get(['id', 'name']);
        return view('admin.diamond_topups.create', compact('games'));
    }

    public function store(Request $request)
    {
        // Validasi data (sudah betul)
        $validatedData = $request->validate([
            'game_id' => 'required|exists:games,id',
            'name' => 'required|string|max:255',
            'amount' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // Keselamatan: Gunakan data yang telah divalidasi
        DiamondTopup::create($validatedData);

        return redirect()->route('admin.diamond-topups.index')->with('success', 'Pakej top-up berjaya ditambah.');
    }

    public function edit(DiamondTopup $diamondTopup)
    {
        // Amalan terbaik: Ambil hanya data yang diperlukan
        $games = Game::orderBy('name')->get(['id', 'name']);
        return view('admin.diamond_topups.edit', compact('diamondTopup', 'games'));
    }

    public function update(Request $request, DiamondTopup $diamondTopup)
    {
        // Validasi data (sudah betul)
        $validatedData = $request->validate([
            'game_id' => 'required|exists:games,id',
            'name' => 'required|string|max:255',
            'amount' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // Keselamatan: Gunakan data yang telah divalidasi untuk mengemaskini
        $diamondTopup->update($validatedData);

        return redirect()->route('admin.diamond-topups.index')->with('success', 'Pakej top-up berjaya dikemaskini.');
    }

    public function destroy(DiamondTopup $diamondTopup)
    {
        $diamondTopup->delete();
        return redirect()->route('admin.diamond-topups.index')->with('success', 'Pakej top-up berjaya dipadam.');
    }
}
