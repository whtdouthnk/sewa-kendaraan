<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    /** @use HasFactory<\Database\Factories\TransaksiFactory> */
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = [
        'kode_transaksi',
        'user_id',
        'kendaraan_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'lama_sewa',
        'total_harga',
        'petugas_id',
        'status',
        'status_pembayaran', 
        'keterangan',
    ];

     // relasi ke kendaraan
     public function kendaraan()
     {
         return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
     }
 
     // relasi ke user (penyewa)
     public function user()
     {
         return $this->belongsTo(User::class, 'user_id');
     }
 
     // relasi ke petugas
     public function petugas()
     {
         return $this->belongsTo(User::class, 'petugas_id');
     }
}
