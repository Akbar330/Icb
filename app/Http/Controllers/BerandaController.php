<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    //
    public function index() {
        $berita = Berita::latest()->take(3)->get();

        return view('beranda.index', compact('berita'));
    }

}
