<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        // Fetch all articles
        $artikels = Artikel::latest()->paginate(3); // Mengembalikan LengthAwarePaginator


        // Return view with articles data
        return view('artikel.index', compact('artikels'));
    }

    public function show($id)
    {
        // Find article by ID or fail
        $artikels = Artikel::findOrFail($id);
        return view('artikel.show', compact('artikels'));
    }

    public function search(Request $request)
    {
        // Validate the search query
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        // Perform search in the database
        $query = $request->input('query');
        $artikels = Artikel::where('judul', 'LIKE', "%$query%")
            ->orWhere('konten', 'LIKE', "%$query%")
            ->get();

        // Return view with search results
        return view('artikel.search', compact('artikels', 'query'));
    }
}


