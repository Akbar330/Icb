<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PollingController extends Controller
{
    public function vote(Request $request)
    {

        try {
            // Mendapatkan session_id dan ip_address pengguna
            $sessionId = session()->getId();
            $ipAddress = $request->ip();
            $pilihan = $request->pilihan;
            $todayDate = Carbon::today()->toDateString(); // Format YYYY-MM-DD

            // Cek apakah session_id dan ip_address sudah ada di polling_history pada hari ini

            $existingPoll = DB::table('hasil_votes')->where('session_id', $sessionId)
                ->whereDate('vote_date', $todayDate)
                ->first();

            if ($existingPoll) {
                // Jika sudah melakukan polling hari ini
                Alert::error('error', 'Anda sudah memberikan suara hari ini.');
                return redirect()->back();
            }
            DB::table('hasil_votes')->insert([
                'pilihan_id' => $pilihan,
                'session_id' => $sessionId,
                'ip' => $ipAddress,
                'vote_date' => $todayDate,
            ]);
            Alert::success('success', 'Terima kasih atas suara Anda!');
            return redirect()->back();
        } catch (\Exception $e) {
            //throw $th;
            dd($e);
        }
        // Simpan polling baru

    }
}
