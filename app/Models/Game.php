<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    /**
     * Atribut yang boleh diisi secara besar-besaran (mass assignable).
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'release_date',
        'image_url',
    ];

    /**
     * Hubungan: Satu permainan mempunyai banyak pakej Diamond Topup.
     */
    public function diamondTopups()
    {
        return $this->hasMany(DiamondTopup::class);
    }

    /**
     * Hubungan: Satu permainan boleh dikaitkan dengan banyak akaun pengguna.
     */
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
