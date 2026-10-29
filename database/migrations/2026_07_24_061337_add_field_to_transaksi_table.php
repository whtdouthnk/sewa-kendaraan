<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {

            $table->string('kode_transaksi')
                ->unique()
                ->after('id');

            $table->date('tanggal_pinjam')
                ->after('kendaraan_id');

            $table->date('tanggal_kembali')
                ->after('tanggal_pinjam');

            $table->integer('lama_sewa')
                ->after('tanggal_kembali');

            $table->decimal('total_harga', 12, 2)
                ->default(0)
                ->after('lama_sewa');

            $table->text('keterangan')
                ->nullable()
                ->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {

            $table->dropColumn([
                'kode_transaksi',
                'tanggal_pinjam',
                'tanggal_kembali',
                'lama_sewa',
                'total_harga',
                'keterangan'
            ]);

        });
    }
};