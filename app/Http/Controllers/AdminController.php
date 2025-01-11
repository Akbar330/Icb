<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Artikel;
use App\Models\Berita;
use App\Models\Informasi;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function index()
    {

    $ipAddress = request()->ip(); // Ambil IP pengguna
    $visit = DB::table('visits')->where('ip_address', $ipAddress)->first();

    if ($visit) {
        // Jika sudah ada, periksa apakah lebih dari 24 jam sejak kunjungan terakhir
        $lastVisited = Carbon::parse($visit->last_visited);
        if ($lastVisited->diffInHours(Carbon::now()) >= 24) {
            DB::table('visits')->where('ip_address', $ipAddress)->update([
                'last_visited' => Carbon::now(),
            ]);
        }
    } else {
        // Jika belum ada, tambahkan kunjungan baru
        DB::table('visits')->insert([
            'ip_address' => $ipAddress,
            'last_visited' => Carbon::now(),
        ]);
    }
        // Ambil semua artikel dan berita dari database
        $artikels = Artikel::all();
        $beritas = Berita::all();
        $informasis = Informasi::all();
        $totalArtikels = Artikel::count(); // Hitung total artikel
        $totalBeritas = Berita::count();   // Hitung total berita
        $totalInformasis = Informasi::count(); // Hitung total pengumuman
        $totalVisits = DB::table('visits')->count();

        // Kirim data ke view index
        return view('admin.index', compact('artikels', 'beritas', 'informasis','totalArtikels', 'totalBeritas', 'totalInformasis', 'totalVisits'));
    }
}

