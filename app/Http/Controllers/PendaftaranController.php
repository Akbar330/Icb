<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{

    public function show($id)
{
    $pendaftaran = Pendaftaran::findOrFail($id);
    return view('pendaftaran.success', compact('pendaftarans'));
}

    public function success()
{
    return view('pendaftaran.success');
}


    public function index()
    {
        $pendaftarans = Pendaftaran::all();
        return view('pendaftaran.index', compact('pendaftarans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'alamat' => 'required|string',
            'ttl' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen Protestan,Katolik,Hindu,Buddha,Konghucu',
            'email' => 'required|email|unique:pendaftarans',
            'asal_sekolah' => 'required|string|max:255',
            'jalur_pendaftaran' => 'required|in:Reguler,RMP',
            'jurusan' => 'required|in:TKR,TSM,RPL,TKJ,FAR,KEP',
            'no_hp' => 'required|string|max:20',
            'abk' => 'required|in:Y,N',
            'nama_ortu_wali' => 'required|string|max:255',
            'alamat_wali' => 'required|string',
            'pekerjaan_wali' => 'required|string|max:255',
            'no_hp_wali' => 'required|string|max:20',
            'mgm' => 'required|in:Y,N',
            'nama_mgm' => 'nullable|string|max:255',
            'asal_mgm' => 'nullable|string|max:255',
        ]);

        $pendaftaran = new Pendaftaran();
        $pendaftaran->nama_siswa = $validated['nama_siswa'];
        $pendaftaran->alamat = $validated['alamat'];
        $pendaftaran->ttl = $validated['ttl'];
        $pendaftaran->jenis_kelamin = $validated['jenis_kelamin'];
        $pendaftaran->agama = $validated['agama'];
        $pendaftaran->email = $validated['email'];
        $pendaftaran->asal_sekolah = $validated['asal_sekolah'];
        $pendaftaran->jalur_pendaftaran = $validated['jalur_pendaftaran'];
        $pendaftaran->jurusan = $validated['jurusan'];
        $pendaftaran->no_hp = $validated['no_hp'];
        $pendaftaran->abk = $validated['abk'];
        $pendaftaran->nama_ortu_wali = $validated['nama_ortu_wali'];
        $pendaftaran->alamat_wali = $validated['alamat_wali'];
        $pendaftaran->pekerjaan_wali = $validated['pekerjaan_wali'];
        $pendaftaran->no_hp_wali = $validated['no_hp_wali'];
        $pendaftaran->mgm = $validated['mgm'];
        $pendaftaran->nama_mgm = $validated['nama_mgm'];
        $pendaftaran->asal_mgm = $validated['asal_mgm'];


        $pendaftaran->save();

        return redirect()->route('pendaftaran.success')->with('success', 'Pendaftaran berhasil!');
    }
}
