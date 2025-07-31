<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    /**
     * Atribut yang boleh diisi secara besar-besaran (mass assignable).
     */
    protected $fillable = [
        'user_id',
        'account_id',
        'diamond_topup_id',
        'total_price',
        'status',
        'payment_method',
    ];

    /**
     * Hubungan: Satu transaksi adalah milik seorang pengguna.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Hubungan: Satu transaksi adalah untuk satu akaun permainan.
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Hubungan: Satu transaksi adalah untuk satu pakej topup.
     */
    public function diamondTopup()
    {
        return $this->belongsTo(DiamondTopup::class);
    }

    /**
     * Hubungan: Satu transaksi mempunyai satu bukti pembayaran.
     */
    public function paymentProof()
    {
        return $this->hasOne(PaymentProof::class);
    }

    public function marketAccount()
{
    return $this->belongsTo(MarketAccount::class);
}
}
