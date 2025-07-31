<?php

namespace App\Http\Controllers;

use App\Models\MarketAccount;
use App\Models\Transaction;
use App\Models\PaymentProof;
use App\Models\User;
use App\Notifications\NewPaymentProofUploaded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class MarketPurchaseController extends Controller
{
    /**
     * Simpan transaksi pembelian akaun, bukti bayaran, dan kemaskini status.
     */
    public function store(Request $request)
    {
        // 1. Validasi input khusus untuk pembelian akaun
        $request->validate([
            'market_account_id' => 'required|exists:market_accounts,id',
            'payment_method' => 'required|string',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        try {
            DB::beginTransaction();

            // 2. Dapatkan akaun yang hendak dibeli
            $marketAccount = MarketAccount::findOrFail($request->market_account_id);

            // 3. Pastikan akaun masih tersedia untuk dibeli
            if ($marketAccount->status !== 'available') {
                return back()->with('error', 'Maaf, akaun ini tidak lagi tersedia.');
            }

            // 4. Simpan imej bukti pembayaran
            $path = $request->file('payment_proof')->store('proofs', 'public');

            // 5. Cipta rekod transaksi DAN SIMPAN market_account_id
            $transaction = Transaction::create([
                'user_id' => auth()->id(),
                'market_account_id' => $marketAccount->id, // <-- INI BAHAGIAN PALING PENTING
                'total_price' => $marketAccount->price,
                'status' => 'pending', // Status transaksi adalah pending
                'payment_method' => $request->payment_method,
                // Pastikan lajur lain yang tidak berkaitan adalah null
                'account_id' => null,
                'diamond_topup_id' => null,
            ]);

            // 6. Cipta rekod bukti pembayaran
            PaymentProof::create(['transaction_id' => $transaction->id, 'file_path' => $path]);

            // 7. KEMASKINI STATUS AKAUN PASARAN KEPADA 'pending'
            // Ini menghalang orang lain daripada membeli akaun yang sama
            $marketAccount->status = 'pending';
            $marketAccount->save();

            DB::commit();

            // 8. Hantar notifikasi kepada admin (sama seperti sebelum ini)
            try {
                $admins = User::where('role', 'admin')->get();
                if ($admins->isNotEmpty()) {
                    Notification::send($admins, new NewPaymentProofUploaded($transaction));
                }
            } catch (\Exception $e) {
                \Log::error('Gagal menghantar notifikasi pembelian akaun: ' . $e->getMessage());
            }

            // Arahkan ke halaman sejarah transaksi pengguna
            return redirect()->route('user.transactions.index')->with('success', 'Pembelian anda telah direkodkan. Sila tunggu pengesahan dari admin.');

        } catch (\Exception $e) {
            DB::rollBack();
            // dd($e); // Nyahkomen untuk debug
            return back()->with('error', 'Berlaku ralat semasa memproses pembelian anda.');
        }
    }
}
