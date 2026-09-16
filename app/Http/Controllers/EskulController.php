<?php

namespace App\Http\Controllers;

use App\Models\Eskul;
use App\Models\KegiatanEskul;
use Illuminate\Http\Request;

class EskulController extends Controller
{
    /**
     * Display a listing of extracurriculars and recent articles from all eskuls.
     */
    public function index(Request $request)
    {
        $query = Eskul::withCount('kegiatans');

        if ($request->filled('kategori') && $request->kategori !== 'Semua') {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_eskul', 'like', "%{$search}%")
                  ->orWhere('pembina', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $eskuls = $query->latest()->paginate(12)->withQueryString();

        $kategoriList = [
            'Semua',
            'Olahraga',
            'Seni & Budaya',
            'Kepemimpinan & Bela Negara',
            'Keagamaan',
            'Teknologi & Sains',
            'Bahasa & Sastra',
        ];

        // Ambil artikel/berita kegiatan dari SEMUA eskul untuk ditampilkan di bawah katalog eskul
        $artikels = KegiatanEskul::with('eskul')
            ->latest('tanggal_kegiatan')
            ->latest('created_at')
            ->paginate(6, ['*'], 'artikel_page');

        return view('eskul.index', compact('eskuls', 'kategoriList', 'artikels'));
    }

    /**
     * Display the specified extracurricular and its activities.
     */
    public function show($slug)
    {
        $eskul = Eskul::where('slug', $slug)
            ->orWhere('id', $slug)
            ->firstOrFail();

        $kegiatans = $eskul->kegiatans()->paginate(9);

        $eskulLainnya = Eskul::where('id', '!=', $eskul->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('eskul.show', compact('eskul', 'kegiatans', 'eskulLainnya'));
    }

    /**
     * Display single article from an eskul with rich content.
     */
    public function showArtikel($slug)
    {
        $artikel = KegiatanEskul::with(['eskul', 'user'])
            ->where('slug', $slug)
            ->orWhere('id', $slug)
            ->firstOrFail();

        $artikel->increment('views');

        $artikelLainnya = KegiatanEskul::with('eskul')
            ->where('id', '!=', $artikel->id)
            ->latest()
            ->take(4)
            ->get();

        return view('eskul.artikel.show', compact('artikel', 'artikelLainnya'));
    }
}
