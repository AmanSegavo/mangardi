<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id', 'title',
        'price',
        'attributes', // <-- TAMBAH INI
        'images', 'login_details', 'status'
        // 'description' DIBUANG
    ];

    protected $casts = [
        'images' => 'array',
        'attributes' => 'array', // <-- TAMBAH INI, sangat penting!
        'price' => 'float',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
