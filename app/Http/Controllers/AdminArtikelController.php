<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class AdminArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::all(); // Mengambil semua artikel
        return view('admin.artikel.index', compact('artikels'));
    }

    public function create()
    {
        return view('admin.artikel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'penulis' => 'required|string|max:255',
        ]);

        Artikel::create($request->all());

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function edit($id)
{
    $artikel = Artikel::findOrFail($id);
    return view('admin.artikel.edit', compact('artikel'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'penulis' => 'required|string|max:255',
        'konten' => 'required',
    ]);

    $artikel = Artikel::findOrFail($id);
    $artikel->update([
        'judul' => $request->judul,
        'penulis' => $request->penulis,
        'konten' => $request->konten,
    ]);

    return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui!');
}

public function destroy($id)
{
    $artikel = Artikel::findOrFail($id);
    $artikel->delete();

    return redirect()->route('admin.index')->with('success', 'Artikel berhasil dihapus!');
}

}

