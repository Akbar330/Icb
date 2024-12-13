<?php

namespace App\Http\Controllers;

use App\Models\Kepsek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KepsekController extends Controller
{
    public function index()
    {
        // Mengambil semua data kepsek, meskipun hanya satu yang ada
        $kepsek = Kepsek::all();

        return view('admin.kepsek.index', compact('kepsek'));
    }

    // Menampilkan form untuk membuat kepsek baru
    public function create()
    {
        return view('admin.kepsek.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Cek jika sudah ada data sebelumnya, hapus jika ada
        $existingKepsek = Kepsek::first();
        if ($existingKepsek) {
            $existingKepsek->delete(); // Hapus data lama
        }

        $data = $request->only(['nama', 'konten']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('kepsek', 'public');
        }

        Kepsek::create($data);

        return redirect()->route('admin.kepsek.index')->with('success', 'kepsek berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit kepsek yang ada
    public function edit(kepsek $kepsek)
    {
        return view('admin.kepsek.edit', compact('kepsek'));
    }

    // Memperbarui kepsek yang sudah ada
    public function update(Request $request, kepsek $kepsek)
    {
        $request->validate([
            'nama' => 'required|string',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['nama', 'konten']);

        if ($request->hasFile('gambar')) {
            if ($kepsek->gambar) {
                Storage::disk('public')->delete($kepsek->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('kepsek', 'public');
        }

        $kepsek->update($data);

        return redirect()->route('admin.kepsek.index')->with('success', 'kepsek berhasil diperbarui.');
    }

    // Menghapus kepsek dari database
    public function destroy(kepsek $kepsek)
    {
        if ($kepsek->gambar) {
            Storage::disk('public')->delete($kepsek->gambar);
        }

        $kepsek->delete();

        return redirect()->route('admin.kepsek.index')->with('success', 'kepsek berhasil dihapus.');
    }
}
