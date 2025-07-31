<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Penting untuk membezakan admin dan pengguna
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Hubungan: Seorang pengguna boleh mempunyai banyak akaun permainan.
     */
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    /**
     * Hubungan: Seorang pengguna boleh mempunyai banyak transaksi.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
