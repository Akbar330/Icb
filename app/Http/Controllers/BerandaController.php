<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Artikel;
use App\Models\Carousel;
use App\Models\Oncam;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function index(Request $request)
    {
        $sessionId = session()->getId();
        $ipAddress = $request->ip();
        $pilihan = $request->pilihan;
        $todayDate = Carbon::today()->toDateString();

        $oncams = Oncam::all();
        $carousels = Carousel::orderBy('order')->get();
        $gambarGaleri = Galeri::latest()->paginate(3, ['*'], 'galeri_page');
        $berita = Berita::latest()->paginate(3, ['*'], 'berita_page');
        $artikel = Artikel::latest()->paginate(3, ['*'], 'artikel_page');
        $oncams = Oncam::latest()->paginate(3, ['*'], 'oncam_page'); // Pagination untuk Oncam
        $Q = DB::table('hasil_votes')->where('session_id', $sessionId)
            ->where('ip', $ipAddress)
            ->whereDate('vote_date', $todayDate)
            ->first();
        if ($Q) {
            $isVoting = true;
        } else {
            $isVoting = false;
        }
        $totalVotes = DB::table('hasil_votes')->count();
        $pilihan = DB::table('hasil_votes')
            ->select('pilihan_id', DB::raw('count(*) as count'))
            ->groupBy('pilihan_id')
            ->get()
            ->pluck('count', 'pilihan_id');
        $isVoting = DB::table('hasil_votes')->where('session_id', $sessionId)
            ->where('ip', $ipAddress)
            ->whereDate('vote_date', $todayDate)
            ->exists();
        $sapaan = DB::table('sapaan_kepalas')->get();

        return view('beranda.index', compact('berita', 'gambarGaleri', 'carousels', 'artikel', 'oncams', 'isVoting', 'pilihan', 'totalVotes', 'sapaan'));
    }
}
