<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Artikel;
use App\Models\Carousel;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index() {
        $carousels = Carousel::orderBy('order')->get();  // Mengambil carousels yang diurutkan berdasarkan 'order'
        $gambarGaleri = Galeri::all();  // Mengambil semua gambar galeri
        $berita = Berita::paginate(3);  // Menambahkan pagination untuk berita
        $artikel = Artikel::paginate(3);  // Menambahkan pagination untuk artikel

        return view('beranda.index', compact('berita', 'gambarGaleri', 'carousels', 'artikel'));
    }
}

