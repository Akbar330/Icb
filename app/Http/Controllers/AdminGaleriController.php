<?php

namespace App\Http\Controllers;

use App\Models\Galeri; // Pastikan Anda sudah memiliki model Galeri
use Illuminate\Http\Request;

class AdminGaleriController extends Controller
{
    // Menampilkan halaman index galeri
    public function index() {
        // Mengambil gambar-gambar yang sudah diunggah dari database
        $gambarGaleri = Galeri::all(); // Ambil semua gambar dari database

        // Mengirim data gambar ke view
        return view('admin.galeri.index', compact('gambarGaleri'));
    }

    // Menampilkan form untuk mengunggah gambar
    public function create() {
        return view('admin.galeri.create');
    }

    // Menyimpan gambar yang diunggah
    public function store(Request $request) {
        // Validasi file gambar
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:50000', // maksimal 2MB
        ]);

        // Menyimpan gambar ke folder storage/galeri
        $gambar = $request->file('gambar');
        $gambarPath = $gambar->store('galeri', 'public'); // Simpan ke folder galeri di disk public

        // Menyimpan informasi gambar ke database
        Galeri::create(['filename' => $gambarPath]);

        // Kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.galeri.index')->with('success', 'Gambar berhasil diunggah.');
    }
}



