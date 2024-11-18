<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ArtikelExport;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::all();
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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('images/artikels', 'public');
        }

        Artikel::create($data);

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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $artikel = Artikel::findOrFail($id);
        $data = $request->only(['judul', 'penulis', 'konten']);

        if ($request->hasFile('gambar')) {
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('images/artikels', 'public');
        }

        $artikel->update($data);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);

        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }
// Export Excel

    public function exportExcel()
{
    return Excel::download(new ArtikelExport, 'data_artikel.xlsx');
}

// Export PDF
public function exportPdf()
{
    $artikels = Artikel::all();
    $pdf = Pdf::loadView('admin.Artikel.pdf', compact('artikels'));
    return $pdf->download('data_artikel.pdf');
}

public function search(Request $request)
{
    $query = $request->get('query');

    // Pencarian artikel berdasarkan judul, konten, atau penulis
    $artikels = Artikel::where('judul', 'LIKE', "%{$query}%")
        ->orWhere('konten', 'LIKE', "%{$query}%")
        ->orWhere('penulis', 'LIKE', "%{$query}%")
        ->orWhere('gambar', 'LIKE', "%{$query}%")
        ->get();

    return response()->json($artikels);  // Returning data as JSON for AJAX to handle
}

}
