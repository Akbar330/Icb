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
    public function index() {
        $oncams = Oncam::all();
        $carousels = Carousel::orderBy('order')->get();
        $gambarGaleri = Galeri::all();
        $berita = Berita::paginate(3);
        $artikel = Artikel::all(); // atau Artikel::paginate(3)

        return view('beranda.index', compact('berita', 'gambarGaleri', 'carousels', 'artikel', 'oncams'));
    }

}

