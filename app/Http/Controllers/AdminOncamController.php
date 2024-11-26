<?php

namespace App\Http\Controllers;

use App\Models\Oncam;
use Illuminate\Http\Request;


class AdminOncamController extends Controller
{
    public function index() {
        // Menampilkan semua data Oncam
        $oncams = Oncam::all();
        return view('admin.oncam.index', compact('oncams'));
    }

    public function create() {
        // Menampilkan form untuk menambahkan data baru
        return view('admin.oncam.create');
    }

    public function store(Request $request) {
        // Validasi input
        $request->validate([
            'embed_link' => 'required|url' // Menjamin bahwa embed_link berupa URL valid
        ]);

        // Simpan data ke database
        Oncam::create([
            'embed_link' => $request->embed_link
        ]);

        // Redirect ke halaman daftar Oncam dengan pesan sukses
        return redirect()->route('oncam.index')->with('success', 'Data Oncam berhasil ditambahkan.');
    }
}
