<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    //
    public function index() {
        $beritas = Berita::all(); // Mengambil semua data berita
        return view('berita.index', compact('beritas'));
    }

    public function show($id) {
        $berita = Berita::findOrFail($id); // Mengambil data berita berdasarkan ID
        return view('berita.show', compact('berita')); // Mengirim data berita ke view
    }
}
