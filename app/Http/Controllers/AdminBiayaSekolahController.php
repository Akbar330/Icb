<?php

namespace App\Http\Controllers;

use App\Models\BiayaSekolah;
use Illuminate\Http\Request;

class AdminBiayaSekolahController extends Controller
{
    // Menampilkan daftar biaya sekolah
    public function index()
    {
        // Mengambil semua data biaya sekolah dari database
        $biayaSekolah = BiayaSekolah::all();

        // Mengirim data biaya sekolah ke view
        return view('admin.biaya.index', compact('biayaSekolah'));
    }

    // Menampilkan form untuk menambah biaya sekolah
    public function create()
    {
        return view('admin.biaya.create');
    }

    // Menyimpan biaya sekolah yang baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_biaya' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'jumlah_non' => 'required|numeric|min:0',
        ]);

        // Menyimpan data biaya sekolah
        BiayaSekolah::create([
            'nama_biaya' => $request->nama_biaya,
            'jumlah' => $request->jumlah,
            'jumlah_non' => $request->jumlah_non,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.biaya.index')->with('success', 'Biaya sekolah berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit biaya sekolah
    public function edit($id)
    {
        $biaya = BiayaSekolah::findOrFail($id);

        return view('admin.biaya.edit', compact('biaya'));
    }

    // Memperbarui data biaya sekolah
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_biaya' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'jumlah_non' => 'required|numeric|min:0',
        ]);

        // Mengambil data biaya sekolah
        $biaya = BiayaSekolah::findOrFail($id);

        // Mengupdate data biaya sekolah
        $biaya->update([
            'nama_biaya' => $request->nama_biaya,
            'jumlah' => $request->jumlah,
            'jumlah_non' => $request->jumlah_non,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.biaya.index')->with('success', 'Biaya sekolah berhasil diperbarui.');
    }

    // Menghapus biaya sekolah
    public function destroy($id)
    {
        // Mengambil data biaya sekolah
        $biaya = BiayaSekolah::findOrFail($id);

        // Menghapus data biaya sekolah
        $biaya->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.biaya.index')->with('success', 'Biaya sekolah berhasil dihapus.');
    }
}
