<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory;

    // Pastikan kolom 'image_path' ada dalam daftar $fillable
    protected $fillable = ['order', 'image_path']; // Sesuaikan dengan nama kolom yang benar
}
