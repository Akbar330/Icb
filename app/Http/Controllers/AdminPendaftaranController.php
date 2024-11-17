<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;

class AdminPendaftaranController extends Controller
{
    //
    public function show($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    public function index()
    {
        $pendaftarans = Pendaftaran::all();

        // Mengelompokkan berdasarkan jurusan dan jenis kelamin
        $jurusanData = Pendaftaran::select('jurusan', 'jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jurusan', 'jenis_kelamin')
            ->get();

        // Mengelompokkan berdasarkan jurusan saja untuk total
        $jurusanTotal = Pendaftaran::select('jurusan', DB::raw('count(*) as total'))
            ->groupBy('jurusan')
            ->get();
    
        $chartData = DB::table('pendaftarans')
            ->select('jurusan', DB::raw("COUNT(CASE WHEN jenis_kelamin = 'Laki-laki' THEN 1 END) AS total_male,COUNT(CASE WHEN jenis_kelamin = 'Perempuan' THEN 1 END) AS total_female "))
            ->groupBy('jurusan')
            ->get()->toArray();
        // return view('admin.pendaftaran.index', compact('pendaftarans', 'jurusanData', 'jurusanTotal'));
       
        return view('admin.pendaftaran.index', compact('pendaftarans', 'chartData'));
    }

}
