<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BeritaExport;
use Barryvdh\DomPDF\Facade\Pdf;
class AdminBeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::all(); // Mengambil semua berita
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
            'penulis' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'konten' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->only(['judul', 'penulis', 'deskripsi', 'konten']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('images/beritas', 'public');
        }

        Berita::create($data);

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
            'deskripsi' => 'nullable|string',
            'konten' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $berita = Berita::findOrFail($id);

        $data = $request->only(['judul', 'penulis', 'deskripsi', 'konten']);

        if ($request->hasFile('gambar')) {
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('images/beritas', 'public');
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus gambar jika ada
        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }
        // Export Excel

        public function exportExcel()
        {
            return Excel::download(new beritaExport, 'data_berita.xlsx');
        }

        // Export PDF
        public function exportPdf()
        {
            $beritas = berita::all();
            $pdf = Pdf::loadView('admin.berita.pdf', compact('beritas'));
            return $pdf->download('data_berita.pdf');
        }

        public function search(Request $request)
        {
            $query = $request->get('query');

            // Pencarian berita berdasarkan judul, konten, atau penulis
            $beritas = berita::where('judul', 'LIKE', "%{$query}%")
                ->orWhere('konten', 'LIKE', "%{$query}%")
                ->orWhere('penulis', 'LIKE', "%{$query}%")
                ->orWhere('gambar', 'LIKE', "%{$query}%")
                ->get();

            return response()->json($beritas);  // Returning data as JSON for AJAX to handle
        }

}
