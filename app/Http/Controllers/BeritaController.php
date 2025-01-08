<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Artikel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    //
    public function index() {
        $beritas = Berita::latest()->paginate(3);
        $artikels = Artikel::latest()->take(5)->get(); // Ambil artikel terkini (limit 5)

        // Return view dengan data
        return view('berita.index', compact('beritas', 'artikels'));

    }

    public function show($id, Request $request)
    {
        // Find article by ID or fail
        $beritas = berita::findOrFail($id);

        // Mendapatkan IP address pengguna
        $ipAddress = $request->ip();

        // Memeriksa apakah IP address sudah melihat berita ini dalam 24 jam terakhir
        $ipCheck = DB::table('berita_views')
            ->where('berita_id', $id)
            ->where('ip_address', $ipAddress)
            ->where('created_at', '>=', now()->subDay())
            ->exists();

        if (!$ipCheck) {
            // Tambahkan IP address ke tabel 'berita_views'
            DB::table('berita_views')->insert([
                'berita_id' => $id,
                'ip_address' => $ipAddress,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Increment kolom 'views' di tabel 'beritas'
            $beritas->increment('views');
        }

        return view('berita.show', compact('beritas'));

    }
}
