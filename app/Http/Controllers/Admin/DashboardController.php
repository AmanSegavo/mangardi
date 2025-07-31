<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Game;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data admin yang login
        $user = Auth::user();

        // Ambil statistik untuk dashboard admin
        $stats = [
            'total_users' => User::count(),
            'total_transactions' => Transaction::count(),
            'total_games' => Game::count(),
            'total_revenue' => Transaction::where('status', 'completed')->sum('total_price')
        ];

        // Ambil 5 transaksi terbaru dari semua user
        $transactions = Transaction::with(['user', 'account.game', 'diamondTopup'])
            ->latest()
            ->take(5)
            ->get();

        // Kirim semua data ke view admin
        return view('admin.dashboard', compact('user', 'transactions', 'stats'));
    }
}
