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
        // Start Polling
        $masterPolling = null;
        $isVoting = false;
        $listPilihan = [];
        $pilihan = [];
        $totalVotes = 0;

        $pollingAya = DB::table('master_pollings as mp')
            ->where('mp.isShowing', true)
            ->select('mp.id', 'mp.nama_polling', 'mp.isShowing')
            ->exists();

        if ($pollingAya) {
            $masterPolling = DB::table('master_pollings as mp')
                ->where('mp.isShowing', true)
                ->select('mp.id', 'mp.nama_polling', 'mp.isShowing')
                ->first();

            $isVoting = DB::table('hasil_votes')
                ->where('id_polling', '=', $masterPolling->id)
                ->where('session_id', $sessionId)
                ->whereDate('vote_date', $todayDate)
                ->exists();

            $listPilihan = DB::table('pilihan_votes')
                ->where('id_polling', '=', $masterPolling->id)
                ->orderBy('id', 'asc')
                ->select('id', 'option')
                ->get();

            // PERHitungan
            $totalVotes = DB::table('hasil_votes')->where('id_polling','=',$masterPolling->id)->count();
            $pilihanRAW = DB::table('pilihan_votes')
            ->leftJoin('hasil_votes', function($join) use ($masterPolling) {
                $join->on('pilihan_votes.id', '=', 'hasil_votes.pilihan_id')
                     ->where('hasil_votes.id_polling', '=', $masterPolling->id);
            })
            ->where('pilihan_votes.id_polling', '=', $masterPolling->id)
            ->select('pilihan_votes.id as pilihan_id', DB::raw('COUNT(hasil_votes.pilihan_id) as count'))
            ->groupBy('pilihan_votes.id')
            ->get();
            foreach ($pilihanRAW as $item) {
                $pilihan[] = [
                    'pilihan_id' => $item->pilihan_id,
                    'count' => $item->count,
                ];
            }
        }

        // END Polling
        $sapaan = DB::table('sapaan_kepalas')->select('sapaan', 'gambar')->orderBy('created_at', 'desc')->get()->toJson();

        $kepsek = DB::table('kepsek')->get();
        return view('beranda.index', compact('berita', 'gambarGaleri', 'carousels', 'artikel', 'oncams', 'isVoting', 'pilihan', 'totalVotes', 'sapaan', 'kepsek', 'masterPolling', 'listPilihan', 'pollingAya'));
    }
}
