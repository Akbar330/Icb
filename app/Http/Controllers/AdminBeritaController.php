<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class AdminBeritaController extends Controller
{
    //
    public function index()
    {
        $beritas= Berita::all(); // Mengambil semua artikel
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'penulis' => 'required|string|max:255',
        ]);

        Berita::create($request->all());

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
{
    $berita = Berita::findOrFail($id);
    return view('admin.berita.edit', compact('berita'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'penulis' => 'required|string|max:255',
        'konten' => 'required',
    ]);

    $berita = Berita::findOrFail($id);
    $berita->update([
        'judul' => $request->judul,
        'penulis' => $request->penulis,
        'konten' => $request->konten,
    ]);

    return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
}

public function destroy($id)
{
    $berita = Berita::findOrFail($id);
    $berita->delete();

    return redirect()->route('admin.index')->with('success', 'Berita berhasil dihapus!');
}

}
