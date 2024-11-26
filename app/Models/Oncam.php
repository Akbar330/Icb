<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oncam extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi secara mass-assignment
    protected $fillable = ['embed_link'];
}
