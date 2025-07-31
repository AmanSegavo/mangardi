<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentProof extends Model
{
    use HasFactory;

    /**
     * Atribut yang boleh diisi secara besar-besaran (mass assignable).
     */
    protected $fillable = [
        'transaction_id',
        'file_path',
    ];

    /**
     * Hubungan: Satu bukti pembayaran adalah milik satu transaksi.
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
