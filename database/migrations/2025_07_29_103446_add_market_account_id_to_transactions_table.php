<?php

// ---- TAMBAH TIGA BARIS INI ----
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
        Schema::table('transactions', function (Blueprint $table) {
            // Tambah kolum ini selepas 'diamond_topup_id'. Ia boleh null kerana tidak semua transaksi adalah pembelian akaun.
            $table->foreignId('market_account_id')->nullable()->constrained()->onDelete('set null')->after('diamond_topup_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['market_account_id']);
            $table->dropColumn('market_account_id');
        });
    }
};
