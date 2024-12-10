<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikels'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key
    public $timestamps = true; // Otomatis untuk created_at & updated_at

    protected $fillable = ['judul','deskripsi', 'konten', 'penulis','gambar'];
}
