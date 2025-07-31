<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game; // <-- Import model yang diperlukan
use App\Models\MarketAccount; // <-- Import model yang diperlukan

class WelcomeController extends Controller
{
    /**
     * Paparkan halaman utama dengan SEMUA data yang diperlukan untuk katalog.
     */
    public function index()
    {
        // ===================================================================
        // BAHAGIAN 1: Mengambil data untuk "Akun Terbaru di Pasaran"
        // Ini akan mencipta pembolehubah $marketAccounts
        // ===================================================================
        $marketAccounts = MarketAccount::with('game')
            ->where('status', 'available') // Ambil hanya akaun yang statusnya 'available'
            ->latest()                     // Susun ikut yang paling baru ditambah
            ->take(4)                      // Ambil 4 akaun sahaja untuk pratonton
            ->get();

        // ===================================================================
        // BAHAGIAN 2: Mengambil data untuk "Tersedia Top Up Untuk"
        // Ini akan mencipta pembolehubah $gamesForTopup
        // ===================================================================
        $gamesForTopup = Game::whereHas('diamondTopups') // Pastikan hanya game yang ada pakej top-up
            ->orderBy('name')
            ->get();

        // ===================================================================
        // BAHAGIAN 3: Menghantar KEDUA-DUA pembolehubah ke view
        // Pastikan nama kunci ('marketAccounts', 'gamesForTopup') sepadan
        // dengan apa yang digunakan dalam fail welcome.blade.php
        // ===================================================================
        return view('welcome', [
            'marketAccounts' => $marketAccounts,
            'gamesForTopup' => $gamesForTopup,
        ]);
    }
}   
