<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Berita;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil semua artikel dan berita dari database
        $artikels = Artikel::all();
        $beritas = Berita::all();

        // Kirim data ke view index
        return view('admin.index', compact('artikels', 'beritas'));
    }
}

