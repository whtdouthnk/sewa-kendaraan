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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained('users')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
            
            $table->foreignId('kendaraan_id')
            ->constrained('kendaraan')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

            $table->foreignId('petugas_id')
            ->nullable()
            ->constrained('users')
            ->cascadeOnDelete();

            $table->enum('status',['Menunggu','Disetujui','Dipinjam','Selesai','Dibatalkan'])
            ->default('Menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
