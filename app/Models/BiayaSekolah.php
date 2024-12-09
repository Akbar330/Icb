<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaSekolah extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari plural model
    protected $table = 'biaya_sekolah';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = ['nama_biaya', 'jumlah', 'jumlah_non','keterangan'];

    // Tentukan tipe data untuk kolom 'jumlah'
    protected $casts = [
        'jumlah' => 'decimal:2',
        'jumlah_non' => 'decimal:2',
    ];
}
