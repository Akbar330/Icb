<?php

namespace App\Http\Controllers;

use App\Models\Eskul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class AdminEskulController extends Controller
{
    /**
     * Display a listing of eskuls (for admin) or redirect to own eskul (for eskul role).
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'eskul') {
            if (!$user->eskul_id) {
                return view('admin.eskul.no_assigned');
            }
            return redirect()->route('admin.eskul.edit', $user->eskul_id);
        }

        $eskuls = Eskul::withCount(['kegiatans', 'users'])->latest()->paginate(10);
        return view('admin.eskul.index', compact('eskuls'));
    }

    /**
     * Show the form for creating a new eskul (admin only).
     */
    public function create()
    {
        if (auth()->user()->role === 'eskul') {
            abort(403, 'Hanya Super Admin yang dapat menambahkan master eskul baru.');
        }

        $kategoriList = [
            'Olahraga',
            'Seni & Budaya',
            'Kepemimpinan & Bela Negara',
            'Keagamaan',
            'Teknologi & Sains',
            'Bahasa & Sastra',
            'Lainnya',
        ];

        return view('admin.eskul.create', compact('kategoriList'));
    }

    /**
     * Store a newly created eskul (admin only).
     */
    public function store(Request $request)
    {
        if (auth()->user()->role === 'eskul') {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'nama_eskul' => 'required|string|max:255',
            'kategori'   => 'required|string',
            'pembina'    => 'nullable|string|max:255',
            'ketua'      => 'nullable|string|max:255',
            'jadwal'     => 'nullable|string|max:255',
            'tempat'     => 'nullable|string|max:255',
            'deskripsi'  => 'nullable|string',
            'visi_misi'  => 'nullable|string',
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('eskul', 'public');
        }

        Eskul::create([
            'nama_eskul' => $request->nama_eskul,
            'slug'       => Str::slug($request->nama_eskul) . '-' . Str::random(4),
            'kategori'   => $request->kategori,
            'pembina'    => $request->pembina,
            'ketua'      => $request->ketua,
            'jadwal'     => $request->jadwal,
            'tempat'     => $request->tempat,
            'deskripsi'  => $request->deskripsi,
            'visi_misi'  => $request->visi_misi,
            'foto'       => $fotoPath,
        ]);

        Alert::success('Berhasil', 'Ekstrakurikuler berhasil ditambahkan!');
        return redirect()->route('admin.eskul.index');
    }

    /**
     * Show form for editing an eskul.
     * Admin can edit any eskul; Eskul role can only edit their assigned eskul.
     */
    public function edit($id)
    {
        $user = auth()->user();

        if ($user->role === 'eskul' && $user->eskul_id != $id) {
            abort(403, 'Anda hanya dapat mengelola data ekstrakurikuler Anda sendiri.');
        }

        $eskul = Eskul::findOrFail($id);

        $kategoriList = [
            'Olahraga',
            'Seni & Budaya',
            'Kepemimpinan & Bela Negara',
            'Keagamaan',
            'Teknologi & Sains',
            'Bahasa & Sastra',
            'Lainnya',
        ];

        return view('admin.eskul.edit', compact('eskul', 'kategoriList'));
    }

    /**
     * Update the specified eskul.
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();

        if ($user->role === 'eskul' && $user->eskul_id != $id) {
            abort(403, 'Anda hanya dapat mengelola data ekstrakurikuler Anda sendiri.');
        }

        $eskul = Eskul::findOrFail($id);

        $request->validate([
            'nama_eskul' => 'required|string|max:255',
            'kategori'   => 'required|string',
            'pembina'    => 'nullable|string|max:255',
            'ketua'      => 'nullable|string|max:255',
            'jadwal'     => 'nullable|string|max:255',
            'tempat'     => 'nullable|string|max:255',
            'deskripsi'  => 'nullable|string',
            'visi_misi'  => 'nullable|string',
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $data = [
            'nama_eskul' => $request->nama_eskul,
            'kategori'   => $request->kategori,
            'pembina'    => $request->pembina,
            'ketua'      => $request->ketua,
            'jadwal'     => $request->jadwal,
            'tempat'     => $request->tempat,
            'deskripsi'  => $request->deskripsi,
            'visi_misi'  => $request->visi_misi,
        ];

        if ($request->hasFile('foto')) {
            if ($eskul->foto && Storage::disk('public')->exists($eskul->foto)) {
                Storage::disk('public')->delete($eskul->foto);
            }
            $data['foto'] = $request->file('foto')->store('eskul', 'public');
        }

        $eskul->update($data);

        Alert::success('Berhasil', 'Informasi ekstrakurikuler berhasil diperbarui!');

        if ($user->role === 'eskul') {
            return redirect()->route('admin.eskul.edit', $eskul->id);
        }

        return redirect()->route('admin.eskul.index');
    }

    /**
     * Remove the specified eskul (admin only).
     */
    public function destroy($id)
    {
        if (auth()->user()->role === 'eskul') {
            abort(403, 'Hanya Super Admin yang dapat menghapus data ekstrakurikuler.');
        }

        $eskul = Eskul::findOrFail($id);

        if ($eskul->foto && Storage::disk('public')->exists($eskul->foto)) {
            Storage::disk('public')->delete($eskul->foto);
        }

        $eskul->delete();

        Alert::success('Berhasil', 'Ekstrakurikuler berhasil dihapus!');
        return redirect()->route('admin.eskul.index');
    }
}
