<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah suai lajur dalam jadual transactions
        Schema::table('transactions', function (Blueprint $table) {
            // Tukar 'decimal' kepada jenis yang boleh simpan nilai lebih besar
            $table->decimal('total_price', 15, 2)->change();
        });

        // Ubah suai lajur dalam jadual market_accounts
        Schema::table('market_accounts', function (Blueprint $table) {
            // Pastikan kedua-dua lajur adalah sama jenis
            $table->decimal('price', 15, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Kembalikan kepada saiz asal jika perlu rollback
            $table->decimal('total_price', 8, 2)->change();
        });

        Schema::table('market_accounts', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->change();
        });
    }
};
