<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Artikel;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    //
    public function index() {
        $beritas = Berita::all();
        $artikels = Artikel::latest()->take(5)->get(); // Ambil artikel terkini (limit 5)

        // Return view dengan data
        return view('berita.index', compact('beritas', 'artikels'));

    }

    public function show($id) {
        $berita = Berita::findOrFail($id); // Mengambil data berita berdasarkan ID
        return view('berita.show', compact('berita')); // Mengirim data berita ke view
    }
}
