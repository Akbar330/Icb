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
        return view('admin.sapa.index',compact('sapaan'));
     }
   
     
     public function create(){
         return view('admin.sapa.create');
     }
     public function editSapaan($id){
        $sapaan =  DB::table('sapaan_kepalas')->where('id','=',$id)->first();
        return view('admin.sapa.edit',compact('sapaan'));
     }

    public function storeSapaan(Request $request)
    {
        try {
            DB::table('sapaan_kepalas')->insert([
                "sapaan" => $request->sapaan,
                'created_at' => Carbon::now()
            ]);
            Alert::success('success', 'SAPAAN TELAH DIKIRIM!');
            return redirect()->route('admin.sapa.index');
        } catch (\Exception $e) {
            Alert::error('error', $e->getMessage());
            return redirect()->route('admin.sapa.index');
        }
    }

    public function updateSapaan(Request $request ,$id){
        try {
            DB::table('sapaan_kepalas')->where('id',$id)->update([
                "sapaan" => $request->sapaan,
                "updated_at"=> Carbon::now()
            ]);
            Alert::success('success', 'SAPAAN TELAH DIKIRIM!');
            return redirect()->route('admin.sapa.index');
        } catch (\Exception $e) {
            Alert::error('error', $e->getMessage());
            return redirect()->route('admin.sapa.index');
        }
    }
    public function destroySapaan(Request $request ,$id){
        try {
            DB::table('sapaan_kepalas')->where('id',$id)->delete();
            Alert::success('success', 'SAPAAN TELAH DIHapus!');
            return redirect()->route('admin.sapa.index');
        } catch (\Exception $e) {
            Alert::error('error', $e->getMessage());
            return redirect()->route('admin.sapa.index');
        }
    }
}
