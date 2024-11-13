<?php

namespace App\Http\Controllers;
use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    //
    public function index() {
        $informasi = Informasi::all();
        return view('informasi.index', compact('informasi'));
    }

    public function show($id) {
        // Ambil data informasi berdasarkan ID
        $informasi = Informasi::findOrFail($id);

        // Kirimkan data ke tampilan show
        return view('informasi.show', compact('informasi'));
    }
}
