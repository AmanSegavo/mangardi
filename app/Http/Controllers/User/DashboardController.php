<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Paparkan dashboard utama untuk pengguna yang telah log masuk.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // 1. Dapatkan maklumat pengguna yang sedang log masuk.
        $user = Auth::user();

        // 2. Dapatkan 5 transaksi terkini milik pengguna tersebut.
        //    'with()' digunakan untuk memuatkan data dari jadual lain (games, diamond_topups)
        //    dengan cekap (mengelakkan masalah N+1 query).
        $transactions = $user->transactions()
                              ->with(['account.game', 'diamondTopup'])
                              ->latest() // Susun mengikut tarikh paling baru
                              ->take(5)  // Ambil 5 rekod sahaja
                              ->get();

        // 3. Hantar kedua-dua pembolehubah ($user dan $transactions) ke view.
        //    View ini dijangka berada di: resources/views/dashboard.blade.php
        return view('dashboard', compact('user', 'transactions'));
    }
}
