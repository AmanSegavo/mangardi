<?php

namespace App\Http\Controllers;

use App\Models\MarketAccount;
use App\Models\Transaction;
use App\Models\PaymentProof;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Throwable; // <-- TAMBAH INI, amalan terbaik

class MarketplaceController extends Controller
{
    // ... kaedah index(), show(), showPaymentForm() kekal sama ...
    public function index()
    {
        $accounts = MarketAccount::where('status', 'available')->with('game')->latest()->paginate(12);
        return view('marketplace.index', compact('accounts'));
    }

    public function show(MarketAccount $account)
    {
        if ($account->status !== 'available') {
            abort(404, 'Akaun ini tidak lagi tersedia.');
        }
        return view('marketplace.show', compact('account'));
    }

    public function showPaymentForm(MarketAccount $account)
    {
        if ($account->status !== 'available') {
            return redirect()->route('marketplace.index')->with('error', 'Maaf, akaun tersebut baru sahaja dibeli oleh orang lain.');
        }
        return view('marketplace.payment', compact('account'));
    }


    public function processPayment(Request $request)
    {
        $request->validate([
            'market_account_id' => 'required|exists:market_accounts,id',
            'payment_method' => 'required|string',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $account = MarketAccount::findOrFail($request->market_account_id);

        if ($account->status !== 'available') {
            return back()->with('error', 'Maaf, akaun tersebut telah dibeli semasa anda membuat pembayaran.');
        }

        try {
            DB::beginTransaction();

            $account->status = 'pending';
            $account->save();

            $path = null;
            if ($request->hasFile('payment_proof')) {
                $image = $request->file('payment_proof');
                $imageName = time() . '_proof_' . $image->getClientOriginalName();
                $image->move(public_path('images/proofs'), $imageName);
                $path = '/images/proofs/' . $imageName;
            }

            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'market_account_id' => $account->id,
                'total_price' => $account->price,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
            ]);

            PaymentProof::create(['transaction_id' => $transaction->id, 'file_path' => $path]);

            DB::commit();

            return redirect()->route('transactions.index')->with('success', 'Pembelian anda telah direkodkan dan sedang diproses.');

        } catch (Throwable $e) { // <-- Guna Throwable untuk tangkap semua jenis ralat
            DB::rollBack();

            // ============ INI PEMBETULAN UTAMA UNTUK DEBUGGING ============
            // Nyahkomen dd() di bawah buat sementara waktu akan Tunjuk Ralat SEBENAR.

            // Pilihan 1: Tunjuk mesej sahaja
            // dd($e->getMessage());

            // Pilihan 2: Tunjuk keseluruhan ralat (lebih baik)
            dd($e);

            // ================================================================

            return back()->with('error', 'Berlaku ralat yang tidak dijangka semasa memproses pembelian anda. Sila cuba lagi.');
        }
    }
}
