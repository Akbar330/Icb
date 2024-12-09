<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SapaanController extends Controller
{
  
    public function index(){
        $sapaan =  DB::table('sapaan_kepalas')->get();
     }
     
    public function storeSapaan(Request $request)
    {
        try {
            DB::table('sapaan_kepalas')->insert([
                "sapaan" => $request->sapaan,
                'created_at' => Carbon::now()
            ]);
            Alert::success('success', 'SAPAAN TELAH DIKIRIM!');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function updateSapaan(Request $request ,$id){
        try {
            DB::table('sapaan_kepalas')->where('id',$id)->update([
                "sapaan" => $request->sapaan,
                "updated_at"=> Carbon::now()
            ]);
            Alert::success('success', 'SAPAAN TELAH DIKIRIM!');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('error', $e->getMessage());
            return redirect()->back();
        }
    }
}
