<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Eskul extends Model
{
    use HasFactory;

    protected $table = 'eskuls';

    protected $fillable = [
        'nama_eskul',
        'slug',
        'kategori',
        'pembina',
        'ketua',
        'jadwal',
        'tempat',
        'foto',
        'deskripsi',
        'visi_misi',
    ];

    /**
     * Auto generate slug from nama_eskul if not set
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($eskul) {
            if (empty($eskul->slug)) {
                $eskul->slug = Str::slug($eskul->nama_eskul);
            }
        });
    }

    public function kegiatans()
    {
        return $this->hasMany(KegiatanEskul::class, 'eskul_id')->orderBy('created_at', 'desc');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'eskul_id');
    }
}
