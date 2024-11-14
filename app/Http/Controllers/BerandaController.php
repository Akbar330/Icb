<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Models\Galeri;

class BerandaController extends Controller
{
    //
    public function index() {
        $gambarGaleri = Galeri::all();
        $berita = Berita::latest()->take(3)->get();

        return view('beranda.index', compact('berita', 'gambarGaleri'));
    }

}
