<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    // Menambahkan 'filename' ke dalam properti fillable
    protected $fillable = ['filename'];
}

