<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Support\Facades\DB;
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

    public function show($id, Request $request)
    {
        // Find article by ID or fail
        $artikels = Artikel::findOrFail($id);

        // Mendapatkan IP address pengguna
        $ipAddress = $request->ip();

        // Memeriksa apakah IP address sudah melihat artikel ini dalam 24 jam terakhir
        $ipCheck = DB::table('artikel_views')
            ->where('artikel_id', $id)
            ->where('ip_address', $ipAddress)
            ->where('created_at', '>=', now()->subDay())
            ->exists();

        if (!$ipCheck) {
            // Tambahkan IP address ke tabel 'artikel_views'
            DB::table('artikel_views')->insert([
                'artikel_id' => $id,
                'ip_address' => $ipAddress,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Increment kolom 'views' di tabel 'artikels'
            $artikels->increment('views');
        }

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


