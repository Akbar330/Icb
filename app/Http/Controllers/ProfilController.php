<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        // Anda bisa mengganti data ini dengan data dari database jika perlu
        $dataProfil = [
            'nama_sekolah' => 'Sekolah Harapan Bangsa',
            'visi' => 'Menjadi sekolah unggulan dalam bidang akademik dan karakter.',
            'misi' => [
                'Membimbing siswa menjadi individu yang cerdas dan berakhlak.',
                'Mengembangkan potensi siswa secara optimal.',
                'Menyediakan lingkungan belajar yang kondusif.',
            ],
            'sejarah' => 'Sekolah ini didirikan pada tahun 1995 dengan tujuan mencetak generasi yang berkompeten.'
        ];

        return view('profil.index', compact('dataProfil'));
    }
}
