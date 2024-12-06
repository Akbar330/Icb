<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PendaftaranController extends Controller
{

    public function show($id)
{
    $pendaftaran = Pendaftaran::findOrFail($id);
    return view('pendaftaran.success', compact('pendaftarans'));
}

    public function success()
{
    return view('pendaftaran.success')->with('success', 'Pendaftaran berhasil!');
}


    public function index()
    {
        $pendaftarans = Pendaftaran::all();
        return view('pendaftaran.index', compact('pendaftarans'));  
    }

    public function store(Request $request)
    {
        try {
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
            ]);
            $pendaftaranData = [
                'nis'=> null,
                'nama_siswa' => $validated['nama_siswa'],
                'alamat' => $validated['alamat'],
                'ttl' => $validated['ttl'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'agama' => $validated['agama'],
                'email' => $validated['email'],
                'asal_sekolah' => $validated['asal_sekolah'],
                'jalur_pendaftaran' => $validated['jalur_pendaftaran'],
                'jurusan' => $validated['jurusan'],
                'no_hp' => $validated['no_hp'],
                'abk' => $validated['abk'],
                'nama_ortu_wali' => $validated['nama_ortu_wali'],
                'alamat_wali' => $validated['alamat_wali'],
                'pekerjaan_wali' => $validated['pekerjaan_wali'],
                'no_hp_wali' => $validated['no_hp_wali'],
                'mgm' => $validated['mgm'],
                'created_at' => Carbon::now(),
            ];
            
            // Jika mgm adalah 'Y', tambahkan nama_mgm dan asal_mgm
            if ($validated['mgm'] === 'Y') {
                $pendaftaranData['nama_mgm'] = $validated['nama_mgm'];
                $pendaftaranData['asal_mgm'] = $validated['asal_mgm'];
            } else {
                $pendaftaranData['nama_mgm'] = null;
                $pendaftaranData['asal_mgm'] = null;
            }
            // Menyimpan data menggunakan query builder
            DB::table('pendaftarans')->insert($pendaftaranData);

            $latestId = DB::table('pendaftarans')->latest('id')->value('id');
            $formattedId = str_pad($latestId, 3, '0', STR_PAD_LEFT);
            $nis = '2526' . $formattedId;

            DB::table('pendaftarans')->where('id','=',$latestId)->update([
                "nis" => $nis
            ]);
            Alert::success('success', 'Pendaftaran berhasil!');
            return redirect()->back();
        } catch (\Exception $ex) {
            // dd($ex);
            Alert::error('Gagal', $ex->getMessage());

            // return redirect()->back()->with('error', $ex->getMessage());

        } 

    }
}