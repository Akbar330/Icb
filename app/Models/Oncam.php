<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Oncam extends Model
{
    //
    use HasFactory;

    // Menambahkan 'filename' ke dalam properti fillable
    protected $fillable = ['embed_link'];
}
