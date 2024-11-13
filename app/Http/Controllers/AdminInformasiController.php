<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminInformasiController extends Controller
{
    // Menampilkan daftar informasi
    public function index()
    {
        $informasis = Informasi::all();
        return view('admin.info.index', compact('informasis'));
    }

    // Menampilkan form untuk membuat informasi baru
    public function create()
    {
        return view('admin.info.create');
    }

    // Menyimpan informasi baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'penulis' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['judul', 'konten', 'penulis', 'tanggal']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('info', 'public');
        }

        Informasi::create($data);

        return redirect()->route('admin.info.index')->with('success', 'Informasi berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit informasi yang ada
    public function edit(Informasi $informasi)
    {
        return view('admin.info.edit', compact('informasi'));
    }

    // Memperbarui informasi yang sudah ada
    public function update(Request $request, Informasi $informasi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'penulis' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['judul', 'konten', 'penulis', 'tanggal']);

        if ($request->hasFile('gambar')) {
            if ($informasi->gambar) {
                Storage::disk('public')->delete($informasi->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('info', 'public');
        }

        $informasi->update($data);

        return redirect()->route('admin.info.index')->with('success', 'Informasi berhasil diperbarui.');
    }

    // Menghapus informasi dari database
    public function destroy(Informasi $informasi)
    {
        if ($informasi->gambar) {
            Storage::disk('public')->delete($informasi->gambar);
        }

        $informasi->delete();

        return redirect()->route('admin.info.index')->with('success', 'Informasi berhasil dihapus.');
    }
}
