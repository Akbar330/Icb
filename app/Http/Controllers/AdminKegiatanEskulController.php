<?php

namespace App\Http\Controllers;

use App\Models\Eskul;
use App\Models\KegiatanEskul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class AdminKegiatanEskulController extends Controller
{
    /**
     * Display a listing of eskul activities/news.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = KegiatanEskul::with(['eskul', 'user']);

        if ($user->role === 'eskul') {
            if (!$user->eskul_id) {
                return view('admin.eskul.no_assigned');
            }
            $query->where('eskul_id', $user->eskul_id);
            $eskulSaya = Eskul::find($user->eskul_id);
            $eskulList = collect([$eskulSaya]);
        } else {
            if ($request->filled('eskul_id')) {
                $query->where('eskul_id', $request->eskul_id);
            }
            $eskulList = Eskul::orderBy('nama_eskul')->get();
        }

        $kegiatans = $query->latest('tanggal_kegiatan')->latest('created_at')->paginate(10)->withQueryString();

        return view('admin.eskul.kegiatan.index', compact('kegiatans', 'eskulList'));
    }

    /**
     * Show the form for creating a new activity/news.
     */
    public function create()
    {
        $user = auth()->user();

        if ($user->role === 'eskul') {
            if (!$user->eskul_id) {
                return view('admin.eskul.no_assigned');
            }
            $eskulSaya = Eskul::findOrFail($user->eskul_id);
            $eskulList = collect([$eskulSaya]);
        } else {
            $eskulList = Eskul::orderBy('nama_eskul')->get();
            if ($eskulList->isEmpty()) {
                Alert::warning('Perhatian', 'Silakan tambahkan data Ekstrakurikuler terlebih dahulu sebelum membuat kegiatan.');
                return redirect()->route('admin.eskul.create');
            }
        }

        return view('admin.eskul.kegiatan.create', compact('eskulList'));
    }

    /**
     * Store a newly created activity/news in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'eskul_id'         => 'required|exists:eskuls,id',
            'judul'            => 'required|string|max:255',
            'penulis'          => 'nullable|string|max:255',
            'tanggal_kegiatan' => 'nullable|date',
            'deskripsi'        => 'required|string',
            'konten'           => 'nullable|string',
            'foto'             => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        // Security check: an eskul user can ONLY upload for their assigned eskul
        if ($user->role === 'eskul' && $user->eskul_id != $request->eskul_id) {
            abort(403, 'Anda tidak diizinkan memposting berita/kegiatan untuk eskul lain.');
        }

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('kegiatan_eskul', 'public');
        }

        KegiatanEskul::create([
            'eskul_id'         => $request->eskul_id,
            'judul'            => $request->judul,
            'slug'             => Str::slug($request->judul) . '-' . Str::random(5),
            'penulis'          => $request->penulis ?: $user->name,
            'tanggal_kegiatan' => $request->tanggal_kegiatan ?? now()->toDateString(),
            'foto'             => $fotoPath,
            'deskripsi'        => $request->deskripsi,
            'konten'           => $request->konten,
            'user_id'          => $user->id,
        ]);

        Alert::success('Berhasil', 'Artikel / Berita Eskul berhasil dipublikasikan!');
        return redirect()->route('admin.kegiatan-eskul.index');
    }

    /**
     * Show the form for editing an activity.
     */
    public function edit($id)
    {
        $user = auth()->user();
        $kegiatan = KegiatanEskul::with('eskul')->findOrFail($id);

        if ($user->role === 'eskul' && $user->eskul_id != $kegiatan->eskul_id) {
            abort(403, 'Anda tidak memiliki hak untuk mengedit kegiatan ini.');
        }

        if ($user->role === 'eskul') {
            $eskulList = collect([$kegiatan->eskul]);
        } else {
            $eskulList = Eskul::orderBy('nama_eskul')->get();
        }

        return view('admin.eskul.kegiatan.edit', compact('kegiatan', 'eskulList'));
    }

    /**
     * Update the specified activity.
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $kegiatan = KegiatanEskul::findOrFail($id);

        if ($user->role === 'eskul' && $user->eskul_id != $kegiatan->eskul_id) {
            abort(403, 'Anda tidak memiliki hak untuk memperbarui kegiatan ini.');
        }

        $request->validate([
            'eskul_id'         => 'required|exists:eskuls,id',
            'judul'            => 'required|string|max:255',
            'penulis'          => 'nullable|string|max:255',
            'tanggal_kegiatan' => 'nullable|date',
            'deskripsi'        => 'required|string',
            'konten'           => 'nullable|string',
            'foto'             => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        if ($user->role === 'eskul' && $user->eskul_id != $request->eskul_id) {
            abort(403, 'Anda tidak dapat memindahkan kegiatan ke eskul lain.');
        }

        $data = [
            'eskul_id'         => $request->eskul_id,
            'judul'            => $request->judul,
            'penulis'          => $request->penulis ?: $user->name,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'deskripsi'        => $request->deskripsi,
            'konten'           => $request->konten,
        ];

        if ($request->hasFile('foto')) {
            if ($kegiatan->foto && Storage::disk('public')->exists($kegiatan->foto)) {
                Storage::disk('public')->delete($kegiatan->foto);
            }
            $data['foto'] = $request->file('foto')->store('kegiatan_eskul', 'public');
        }

        $kegiatan->update($data);

        Alert::success('Berhasil', 'Kegiatan / Berita Eskul berhasil diperbarui!');
        return redirect()->route('admin.kegiatan-eskul.index');
    }

    /**
     * Remove the specified activity.
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $kegiatan = KegiatanEskul::findOrFail($id);

        if ($user->role === 'eskul' && $user->eskul_id != $kegiatan->eskul_id) {
            abort(403, 'Anda tidak memiliki hak untuk menghapus kegiatan ini.');
        }

        if ($kegiatan->foto && Storage::disk('public')->exists($kegiatan->foto)) {
            Storage::disk('public')->delete($kegiatan->foto);
        }

        $kegiatan->delete();

        Alert::success('Berhasil', 'Kegiatan Eskul berhasil dihapus!');
        return redirect()->route('admin.kegiatan-eskul.index');
    }
}
