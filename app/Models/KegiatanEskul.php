<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KegiatanEskul extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_eskuls';

    protected $fillable = [
        'eskul_id',
        'judul',
        'slug',
        'penulis',
        'tanggal_kegiatan',
        'foto',
        'deskripsi',
        'konten',
        'views',
        'user_id',
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kegiatan) {
            if (empty($kegiatan->slug)) {
                $kegiatan->slug = Str::slug($kegiatan->judul) . '-' . Str::random(5);
            }
        });
    }

    public function eskul()
    {
        return $this->belongsTo(Eskul::class, 'eskul_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
