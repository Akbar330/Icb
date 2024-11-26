<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Artikel;
use App\Models\Carousel;
use App\Models\Oncam;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index(Request $request) {
        $oncams = Oncam::all();
        $carousels = Carousel::orderBy('order')->get();
        $gambarGaleri = Galeri::all();
        $berita = Berita::latest()->paginate(3, ['*'], 'berita_page');
        $artikel = Artikel::latest()->paginate(3, ['*'], 'artikel_page');
        $oncams = Oncam::latest()->paginate(3, ['*'], 'oncam_page');
     // atau Artikel::paginate(3)

        return view('beranda.index', compact('berita', 'gambarGaleri', 'carousels', 'artikel', 'oncams'));
    }

}

