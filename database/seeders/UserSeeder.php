<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // <-- Import model User

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cipta 10 pengguna biasa menggunakan UserFactory
        // Setiap pengguna akan mempunyai nama dan e-mel yang rawak
        User::factory(10)->create();
    }
}
