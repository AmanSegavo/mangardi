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
        Schema::create('market_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->json('images')->nullable(); // Untuk menyimpan senarai URL gambar
            $table->text('login_details')->nullable(); // **PENTING:** Ini mesti dienkripsi!
            $table->enum('status', ['available', 'sold', 'pending'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('market_accounts');
    }
};
