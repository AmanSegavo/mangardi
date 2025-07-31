<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // <-- Import model User
use Illuminate\Support\Facades\Hash; // <-- Import Hash facade

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gamestore.com',
            'email_verified_at' => now(), // Sahkan e-mel secara automatik
            'password' => Hash::make('password'), // Kata laluan lalai ialah "password"
            'role' => 'admin', // Tetapkan peranan sebagai admin
        ]);
    }
}
