<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PollingController extends Controller
{
    public function index()
    {
        $masterPollings = DB::table('master_pollings')->select('id', 'nama_polling', 'created_at', 'isShowing')->orderBy('isShowing', 'desc')->get();
        return view('admin.polling.index', compact('masterPollings'));
    }
    public function create()
    {
        return view('admin.polling.create');
    }
    public function store(Request $r)
    {
        $r->validate([
            'nama_polling' => 'required',
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'required',
        ]);
    
        if ($r->input('isShow', 0) == 1) {
            DB::table('master_pollings')
                ->where('isShowing', true)
                ->update(['isShowing' => false]);
        }
    
        $options = [
            'option_1' => $r->input('option_1'),
            'option_2' => $r->input('option_2'),
            'option_3' => $r->input('option_3'),
        ];
    
        DB::beginTransaction();
        try {
            $MasterPollingid = DB::table('master_pollings')->insertGetId(
                [
                    'nama_polling' => $r->input('nama_polling'),
                    'isShowing' => $r->input('isShow', 0),
                    'created_at' => Carbon::now(),
                ]
            );
    
            foreach ($options as $key => $option) {
                DB::table('pilihan_votes')->insert([
                    'id_polling' => $MasterPollingid,
                    'option' => $option,
                    'created_at' => Carbon::now(),
                ]);
            }
    
            DB::commit();
            Alert::success('success', 'Polling Telah Disimpan!');
            return redirect()->route('admin.polling.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('error', 'Terjadi Kesalahan server! Silahkan Hubungi Admin');
            return redirect()->route('admin.polling.index');
        }
    }
    
    public function edit($id)
    {
        $polling = DB::table('master_pollings')->where('id', '=', $id)->select('id', 'nama_polling', 'created_at', 'isShowing')->first();
        $pilihans = DB::table('pilihan_votes')->where('id_polling', '=', $polling->id)->select('id', 'option')->get();
        return view('admin.polling.edit', compact('polling', 'pilihans'));
    }
    public function update(Request $r, $id)
    {
        $r->validate([
            'nama_polling' => 'required',
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'required',
        ]);
        $options = [
            'option_1' => $r->input('option_1'),
            'option_2' => $r->input('option_2'),
            'option_3' => $r->input('option_3'),
        ];
        DB::beginTransaction();
        try {
            if ($r->input('isShow', 0) == 1) {
                DB::table('master_pollings')
                    ->where('isShowing', true)
                    ->update(['isShowing' => false]);
            }
            $currentOptions = DB::table('pilihan_votes')->where('id_polling', '=', $id)->get();
            DB::table('master_pollings')->where('id', '=', $id)->update(
                [
                    'nama_polling' => $r->input('nama_polling'),
                    'isShowing' => $r->input('isShow', 0),
                    'updated_at' => Carbon::now(),
                ]
            );
            foreach ($currentOptions as $index => $currentOption) {
                $newOptionKey = 'option_' . ($index + 1);
                DB::table('pilihan_votes')->where('id_polling', '=', $id)->where('id', '=', $currentOption->id)->update([
                    'option' => $options[$newOptionKey],
                    'updated_at' => Carbon::now(),
                ]);
            }
            DB::commit();
            Alert::success('success', 'Polling Telah Disimpan!');
            return redirect()->route('admin.polling.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('error', 'Terjadi Kesalahan server! Silahkan Hubungi Admin');
            return redirect()->route('admin.polling.index');
        }
    }
    // API SECTION / NO View
    public function changeStatusShow(Request $r, $id)
    {
        $r->validate([
            'isShowing' => 'required',
        ]);

        try {

            $existingPolling = DB::table('master_pollings')
                ->where('isShowing', true)
                ->where('id', '!=', $id)
                ->first();

            if ($existingPolling) {
                Alert::error('error', 'Hanya boleh 1(Satu) polling yang tampil di beranda.');
                return redirect()->route('admin.polling.index');
            }

            DB::table('master_pollings')->where('id', '=', $id)->update(
                [
                    'isShowing' => $r->input('isShowing', 0),
                    'updated_at' => Carbon::now(),
                ]
            );

            Alert::success('success', 'Polling Telah Disimpan!');
            return redirect()->route('admin.polling.index');
        } catch (\Exception $e) {
            Alert::error('error', 'Terjadi Kesalahan server! Silahkan Hubungi Admin');
            return redirect()->route('admin.polling.index');
        }
    }

    public function vote(Request $request)
    {

        try {
            // Mendapatkan session_id dan ip_address pengguna
            $sessionId = session()->getId();
            $ipAddress = $request->ip();
            $pilihan = $request->pilihan;
            $todayDate = Carbon::today()->toDateString(); // Format YYYY-MM-DD
            $idPollingR= $request->id_polling;

            // Cek apakah session_id dan ip_address sudah ada di polling_history pada hari ini

            $existingPoll = DB::table('hasil_votes')->where('id_polling','=',$idPollingR)->where('session_id', $sessionId)
                ->whereDate('vote_date', $todayDate)
                ->first();

            if ($existingPoll) {
                // Jika sudah melakukan polling hari ini
                Alert::error('error', 'Anda sudah memberikan suara hari ini.');
                return redirect()->back();
            }
            DB::table('hasil_votes')->insert([
                'id_polling' => $idPollingR,
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
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            // Delete related records first to avoid foreign key issues
            DB::table('pilihan_votes')->where('id_polling', '=', $id)->delete();
            DB::table('hasil_votes')->where('id_polling', '=', $id)->delete();
            DB::table('master_pollings')->where('id', '=', $id)->delete();

            DB::commit();
            Alert::success('Success', 'Polling telah dihapus!');
            return redirect()->route('admin.polling.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Terjadi kesalahan server! Silakan hubungi admin.');
            return redirect()->route('admin.polling.index');
        }
    }
}
