<?php

namespace App\Http\Controllers;
use App\Models\Artikel;
use App\Models\Informasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    //
    public function index() {
        $informasi = Informasi::all();
        $artikels = Artikel::latest()->take(5)->get();
        return view('informasi.index', compact('informasi', 'artikels'));
    }

    public function show($id, Request $request)
    {
        // Find article by ID or fail
        $informasi = informasi::findOrFail($id);

        // Mendapatkan IP address pengguna
        $ipAddress = $request->ip();

        // Memeriksa apakah IP address sudah melihat informasi ini dalam 24 jam terakhir
        $ipCheck = DB::table('informasi_views')
            ->where('informasi_id', $id)
            ->where('ip_address', $ipAddress)
            ->where('created_at', '>=', now()->subDay())
            ->exists();

        if (!$ipCheck) {
            // Tambahkan IP address ke tabel 'informasi_views'
            DB::table('informasi_views')->insert([
                'informasi_id' => $id,
                'ip_address' => $ipAddress,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Increment kolom 'views' di tabel 'informasi'
            $informasi->increment('views');
        }

        return view('informasi.show', compact('informasi'));
    }

}
