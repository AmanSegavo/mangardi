<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiamondTopup extends Model
{
    use HasFactory;

    /**
     * Atribut yang boleh diisi secara besar-besaran (mass assignable).
     */
    protected $fillable = [
        'game_id',
        'name',
        'amount',
        'price',
    ];

    /**
     * Hubungan: Satu pakej topup adalah milik satu permainan.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
