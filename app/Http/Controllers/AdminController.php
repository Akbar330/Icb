<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Berita;
use App\Models\Informasi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil semua artikel dan berita dari database
        $artikels = Artikel::all();
        $beritas = Berita::all();
        $informasis = Informasi::all();

        // Kirim data ke view index
        return view('admin.index', compact('artikels', 'beritas', 'informasis'));
    }
}

