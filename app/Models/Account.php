<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    /**
     * Atribut yang boleh diisi secara besar-besaran (mass assignable).
     */
    protected $fillable = [
        'user_id',
        'game_id',
        'player_id',
        'nickname',
    ];

    /**
     * Hubungan: Satu akaun adalah milik seorang pengguna.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Hubungan: Satu akaun adalah untuk satu jenis permainan.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Hubungan: Satu akaun permainan boleh mempunyai banyak transaksi.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
