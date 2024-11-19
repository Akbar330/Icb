<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder; // Tambahkan ini jika belum ada

class Carousel extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi
    protected $fillable = ['order', 'created_at', 'updated_at'];

    // Event booting untuk menambahkan Global Scope
    protected static function boot()
    {
        parent::boot();

        // Tambahkan global scope untuk mengurutkan berdasarkan kolom 'order'
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }
}
