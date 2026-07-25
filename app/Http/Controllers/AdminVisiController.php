<?php

namespace App\Http\Controllers;
use App\Models\Visi;

use Illuminate\Http\Request;

class AdminVisiController extends Controller
{
    //
    public function index() {
        $visis = Visi::all();
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

        Visi::create($data);

        return redirect()->route('admin.visi.index')->with('success', 'visi berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit visi yang ada
    public function edit(Visi $visi)
    {
        return view('admin.visi.edit', compact('visi'));
    }

    // Memperbarui visi yang sudah ada
    public function update(Request $request, Visi $visi)
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
    public function destroy(Visi $visi)
    {

        $visi->delete();

        return redirect()->route('admin.visi.index')->with('success', 'visi berhasil dihapus.');
    }
}
