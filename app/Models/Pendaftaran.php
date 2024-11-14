<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    // Field yang dapat diisi (mass assignable)
    protected $fillable = [
        'nama_siswa', 'alamat', 'ttl', 'jenis_kelamin', 'agama', 'email', 'asal_sekolah',
        'jalur_pendaftaran', 'jurusan', 'no_hp', 'abk', 'nama_ortu_wali', 'alamat_wali',
        'pekerjaan_wali', 'no_hp_wali', 'mgm', 'nama_mgm', 'asal_mgm', 'foto_siswa',
        'nilai_raport', 'ijazah'
    ];
}

