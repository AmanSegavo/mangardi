<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Game;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth; // <-- PENTING: Pastikan ini diimport

class AdminController extends Controller
{
    /**
     * Paparkan dashboard utama untuk admin.
     */
    public function dashboard()
    {
        // 1. Dapatkan maklumat admin yang sedang log masuk
        $user = Auth::user();

        // 2. Kumpul data statistik
        $stats = [
            'total_users' => User::count(),
            'total_games' => Game::count(),
            'total_transactions' => Transaction::count(),
            'total_revenue' => Transaction::where('status', 'completed')->sum('total_price'),
        ];

        // 3. Hantar KEDUA-DUA pembolehubah ($user dan $stats) ke view
        return view('admin.dashboard', compact('user', 'stats'));
    }

    // ... (method-method lain kekal sama) ...

    /**
     * Paparkan senarai semua transaksi untuk admin.
     */
    public function transactions()
    {
        $transactions = Transaction::with(['user', 'account.game', 'paymentProof'])->latest()->paginate(15);
        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Kemaskini status satu transaksi.
     */
    public function updateTransactionStatus(Request $request, Transaction $transaction)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,failed',
        ]);

        $transaction->status = $request->status;
        $transaction->save();

        return back()->with('success', 'Status transaksi #' . $transaction->id . ' berjaya dikemaskini.');
    }
}
