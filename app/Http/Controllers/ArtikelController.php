<?php

namespace App\Http\Controllers;

use App\Models\Artikel;

class ArtikelController extends Controller
{
    public function index()
    {
        // Fetch all articles
        $artikels = Artikel::all();

        // Return view with articles data
        return view('artikel.index', compact('artikels'));
    }
}

