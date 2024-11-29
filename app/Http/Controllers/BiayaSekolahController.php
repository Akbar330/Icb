<?php

namespace App\Http\Controllers;

use App\Models\BiayaSekolah;

class BiayaSekolahController extends Controller
{
    public function index()
    {
        // Mengambil semua data biaya sekolah
        $biayaSekolah = BiayaSekolah::all();

        // Mengirim data ke view
        return view('biaya.index', compact('biayaSekolah'));
    }
}

