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
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')
                    ->constrained('kategori')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->string('nama_kendaraan');
            $table->decimal('harga',10,2);
            $table->integer('stok')->default(0);
            $table->enum('status',['Tersedia','Tidak Tersedia']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
