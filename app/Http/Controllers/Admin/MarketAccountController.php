<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // <--- TAMBAH BARIS INI JUGA
use App\Models\MarketAccount;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MarketAccountController extends Controller
{
    public function index()
    {
        $accounts = MarketAccount::with('game')->latest()->paginate(10);
        return view('admin.market_accounts.index', compact('accounts'));
    }

    public function create()
    {
        $games = Game::orderBy('name')->get();
        return view('admin.market_accounts.create', compact('games'));
    }

    public function store(Request $request)
{
    // Pengesahan data termasuk atribut baru
    $validated = $request->validate([
        'game_id' => 'required|exists:games,id',
        'title' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',

        // Pengesahan untuk atribut spesifik
        'attributes' => 'required|array',
        'attributes.rank' => 'nullable|string|max:100',
        'attributes.total_skins' => 'nullable|integer|min:0',
        'attributes.total_heroes' => 'nullable|integer|min:0',
        'attributes.catatan_tambahan' => 'nullable|string',

        // Pengesahan untuk muat naik fail gambar (berganda)
        'images' => 'required|array|min:1',
        'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048', // '*' mengesahkan setiap fail dalam array

        'login_details' => 'required|string',
    ]);

    $imagePaths = [];
    if ($request->hasFile('images')) {
        // Buat folder khusus untuk setiap akaun jika perlu
        $accountImageFolder = 'market_accounts/' . time();

        foreach ($request->file('images') as $image) {
            $imageName = $image->getClientOriginalName();
            // Pindahkan fail ke dalam public/images/market_accounts/xxxxxxxxx
            $image->move(public_path('images/' . $accountImageFolder), $imageName);
            // Simpan laluan penuh
            $imagePaths[] = '/images/' . $accountImageFolder . '/' . $imageName;
        }
    }

    // Sediakan data untuk disimpan
    $dataToStore = [
        'game_id' => $validated['game_id'],
        'title' => $validated['title'],
        'price' => $validated['price'],
        'attributes' => $validated['attributes'], // Simpan sebagai JSON
        'images' => $imagePaths, // Simpan array laluan gambar
        'login_details' => Crypt::encryptString($validated['login_details']),
    ];

    MarketAccount::create($dataToStore);

    return redirect()->route('admin.market-accounts.index')->with('success', 'Akaun jualan berjaya ditambah.');
}

    public function edit(MarketAccount $marketAccount)
    {
        $games = Game::orderBy('name')->get();
        try {
            $marketAccount->login_details = Crypt::decryptString($marketAccount->login_details);
        } catch (\Exception $e) {
            // Biarkan kosong jika tidak boleh didekripsi, elak ralat
            $marketAccount->login_details = "Data login tidak dapat dipaparkan (mungkin rosak atau format lama).";
        }
        return view('admin.market_accounts.edit', compact('marketAccount', 'games'));
    }

    public function update(Request $request, MarketAccount $marketAccount)
    {
        $validated = $request->validate([
            'game_id' => 'required|exists:games,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'images' => 'nullable|string',
            'login_details' => 'required|string',
            'status' => 'required|in:available,sold,pending',
        ]);

        $validated['images'] = $request->images ? array_filter(array_map('trim', explode("\n", $request->images))) : [];
        $validated['login_details'] = Crypt::encryptString($request->login_details);

        $marketAccount->update($validated);

        return redirect()->route('admin.market-accounts.index')->with('success', 'Akaun jualan berjaya dikemaskini.');
    }

    public function destroy(MarketAccount $marketAccount)
    {
        $marketAccount->delete();
        return redirect()->route('admin.market-accounts.index')->with('success', 'Akaun jualan berjaya dipadam.');
    }
}
