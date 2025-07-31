<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Account;
use App\Models\DiamondTopup;
use App\Models\Transaction;
use App\Models\PaymentProof;
use App\Models\User; // <-- TAMBAH INI: Untuk mencari admin
use App\Notifications\NewPaymentProofUploaded; // <-- TAMBAH INI: Kelas notifikasi kita
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification; // <-- TAMBAH INI: Fasad untuk menghantar notifikasi

class TransactionController extends Controller
{
    /**
     * Papar sejarah transaksi untuk pengguna yang sedang log masuk.
     */
    public function index()
    {
        // ... (kod sedia ada, tiada perubahan)
        $transactions = Auth::user()->transactions()->with(['account.game', 'diamondTopup'])->latest()->paginate(10);
        return view('user.transactions.index', compact('transactions'));
    }

    /**
     * Papar borang untuk memulakan transaksi top-up baru.
     */
    public function create(Game $game)
    {
        // ... (kod sedia ada, tiada perubahan)
        $diamondTopups = $game->diamondTopups()->orderBy('price')->get();
        return view('user.transactions.create', compact('game', 'diamondTopups'));
    }

    /**
     * DIKEMAS KINI: Simpan transaksi DAN hantar notifikasi kepada admin.
     */
    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'player_id' => 'required|string|max:255',
            'diamond_topup_id' => 'required|exists:diamond_topups,id',
            'payment_method' => 'required|string',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            DB::beginTransaction();

            // Cipta atau kemaskini akaun pengguna untuk game tersebut
            $account = Account::firstOrCreate(
                ['user_id' => Auth::id(), 'game_id' => $request->game_id,],
                ['player_id' => $request->player_id, 'nickname' => $request->player_id]
            );
            if ($account->wasRecentlyCreated === false && $account->player_id != $request->player_id) {
                $account->player_id = $request->player_id;
                $account->save();
            }

            // Dapatkan maklumat pakej top-up
            $topupPackage = DiamondTopup::findOrFail($request->diamond_topup_id);

            // Simpan imej bukti pembayaran
            $path = $request->file('payment_proof')->store('proofs', 'public');

            // Cipta rekod transaksi utama
            $transaction = Transaction::create([
                'user_id' => Auth::id(), 'account_id' => $account->id, 'diamond_topup_id' => $topupPackage->id,
                'total_price' => $topupPackage->price, 'status' => 'pending', 'payment_method' => $request->payment_method,
            ]);

            // Cipta rekod bukti pembayaran yang berhubung dengan transaksi
            PaymentProof::create(['transaction_id' => $transaction->id, 'file_path' => $path,]);

            DB::commit(); // Sahkan semua perubahan ke pangkalan data

            // ===== BAHAGIAN BARU: HANTAR NOTIFIKASI KEPADA ADMIN =====
            try {
                // Annapan: Anda mengenal pasti admin dengan lajur 'role' bernilai 'admin'
                $admins = User::where('role', 'admin')->get();

                if ($admins->isNotEmpty()) {
                    Notification::send($admins, new NewPaymentProofUploaded($transaction));
                }
            } catch (\Exception $e) {
                // Jika notifikasi gagal dihantar, jangan gagalkan transaksi pengguna.
                // Cukup log ralat untuk semakan pembangun.
                \Log::error('Gagal menghantar notifikasi bukti bayaran baru: ' . $e->getMessage());
            }
            // ===== TAMAT BAHAGIAN NOTIFIKASI =====

            return redirect()->route('user.transactions.index')->with('success', 'Top-up anda telah direkodkan dan sedang diproses.');

        } catch (\Exception $e) {
            DB::rollBack();
            // Untuk tujuan debug, anda boleh nyahkomen baris di bawah
            // dd($e);
            return back()->with('error', 'Berlaku ralat semasa memproses transaksi anda. Sila cuba lagi.');
        }
    }
}
