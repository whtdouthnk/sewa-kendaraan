<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    /** @use HasFactory<\Database\Factories\KendaraanFactory> */
    use HasFactory;
    protected $table = 'kendaraan';
    protected $fillable = [
        'kategori_id',
        'nama_kendaraan',
        'harga',
        
        'status',
        'foto',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
