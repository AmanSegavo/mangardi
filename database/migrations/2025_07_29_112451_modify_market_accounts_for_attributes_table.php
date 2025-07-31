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
        Schema::table('market_accounts', function (Blueprint $table) {
            // 1. Tambah lajur JSON baru untuk menyimpan butiran spesifik
            $table->json('attributes')->nullable()->after('price');

            // 2. Buang lajur description yang lama
            $table->dropColumn('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('market_accounts', function (Blueprint $table) {
            // Jika anda perlu rollback, cipta semula lajur description...
            $table->text('description')->nullable()->after('price');
            // ...dan buang lajur attributes
            $table->dropColumn('attributes');
        });
    }
};
