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
        Schema::table('transactions', function (Blueprint $table) {
            // Ubah suai lajur supaya ia boleh menerima nilai NULL
            $table->foreignId('account_id')->nullable()->change();
            $table->foreignId('diamond_topup_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Jika perlu rollback, jadikan ia tidak nullable semula
            // Perhatian: Ini mungkin gagal jika terdapat data NULL sedia ada
            $table->foreignId('account_id')->nullable(false)->change();
            $table->foreignId('diamond_topup_id')->nullable(false)->change();
        });
    }
};
