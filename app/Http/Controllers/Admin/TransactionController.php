<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\MarketAccount; // <-- PASTIKAN INI DIIMPORT
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- PASTIKAN INI DIIMPORT

class TransactionController extends Controller
{
    /**
     * Paparkan semua transaksi (termasuk top-up & pembelian akaun).
     */
    public function index()
    {
        $transactions = Transaction::with([
            'user',
            'paymentProof',       // Wajib untuk lihat bukti bayaran
            'diamondTopup.game',  // Data untuk transaksi top-up
            'marketAccount.game', // Data untuk transaksi pembelian akaun
        ])->latest()->paginate(15);

        // Fail blade anda sudah betul: 'admin.transactions.index'
        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * KEMASKINI KRITIKAL: Kemaskini status transaksi DAN status MarketAccount jika berkaitan.
     */
    public function updateStatus(Request $request, Transaction $transaction)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,failed',
        ]);

        $newStatus = $request->status;

        // Gunakan DB Transaction untuk memastikan integriti data
        try {
            DB::beginTransaction();

            // 1. Kemaskini status transaksi itu sendiri
            $transaction->status = $newStatus;
            $transaction->save();

            // 2. LOGIK UTAMA: Semak jika ini adalah transaksi pembelian akaun
            if ($transaction->market_account_id) {

                // JIKA TRANSAKSI SELESAI (COMPLETED)
                if ($newStatus === 'completed') {
                    $marketAccount = MarketAccount::find($transaction->market_account_id);
                    if ($marketAccount) {
                        // Tukar status akaun yang dijual kepada 'sold'
                        $marketAccount->status = 'sold';
                        $marketAccount->save();
                    }
                }

                // JIKA TRANSAKSI GAGAL (FAILED)
                elseif ($newStatus === 'failed') {
                    $marketAccount = MarketAccount::find($transaction->market_account_id);
                    // Buka semula jualan akaun HANYA jika status sebelumnya 'pending'
                    if ($marketAccount && $marketAccount->status === 'pending') {
                        $marketAccount->status = 'available';
                        $marketAccount->save();
                    }
                }
            }

            DB::commit(); // Sahkan kedua-dua perubahan jika semua berjaya
            return back()->with('success', 'Status transaksi #' . $transaction->id . ' berjaya dikemaskini.');

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua perubahan jika berlaku ralat
            // dd($e); // Nyahkomen untuk menyahpepijat jika perlu
            return back()->with('error', 'Gagal mengemaskini status. Berlaku ralat pangkalan data.');
        }
    }
}
