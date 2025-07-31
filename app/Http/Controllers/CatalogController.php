<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\MarketAccount;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Paparkan halaman katalog utama dengan semua produk.
     */
    public function index()
    {
        // 1. Ambil semua akaun yang tersedia untuk dijual
        //    - Gunakan `with('game')` untuk elak masalah N+1 query.
        //    - Ambil hanya yang 'available'.
        $marketAccounts = MarketAccount::with('game')
            ->where('status', 'available')
            ->latest() // Papar yang terbaru dahulu
            ->take(8) // Hadkan kepada 8 akaun di halaman utama
            ->get();

        // 2. Ambil semua game yang mempunyai pakej top-up
        //    - Ini memastikan kita tidak memaparkan game yang tidak boleh di-top-up.
        $gamesForTopup = Game::whereHas('diamondTopups')
            ->orderBy('name')
            ->get();

        // 3. Hantar data ke view
        return view('catalog.index', [
            'marketAccounts' => $marketAccounts,
            'gamesForTopup' => $gamesForTopup,
        ]);
    }
}
