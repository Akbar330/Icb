<?php

namespace App\Http\Controllers;
use App\Models\visi;

use Illuminate\Http\Request;

class AdminvisiController extends Controller
{
    //
    public function index() {
        $visis = visi::all();
        return view('admin.visi.index', compact('visis'));
    }

    public function create() {
         return view('admin.visi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
            'tujuan' => 'required|string',
        ]);

        $data = $request->only(['visi', 'misi', 'tujuan']);

        visi::create($data);

        return redirect()->route('admin.visi.index')->with('success', 'visi berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit visi yang ada
    public function edit(visi $visi)
    {
        return view('admin.visi.edit', compact('visi'));
    }

    // Memperbarui visi yang sudah ada
    public function update(Request $request, visi $visi)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
            'tujuan' => 'required|string',
        ]);

        $data = $request->only(['visi', 'misi', 'tujuan']);

        $visi->update($data);

        return redirect()->route('admin.visi.index')->with('success', 'visi berhasil diperbarui.');
    }

    // Menghapus visi dari database
    public function destroy(visi $visi)
    {

        $visi->delete();

        return redirect()->route('admin.visi.index')->with('success', 'visi berhasil dihapus.');
    }
}
