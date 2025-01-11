<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SapaanController extends Controller
{

    public function index(){
        $sapaan =  DB::table('sapaan_kepalas')->latest()->get();
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
             // Validasi input
             $request->validate([
                 'sapaan' => 'required|string|max:255',
                 'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
             ]);

             // Inisialisasi variabel gambar
             $gambarPath = null;

             // Proses upload gambar jika ada
             if ($request->hasFile('gambar')) {
                 $gambarPath = $request->file('gambar')->store('sapaan', 'public');
             }

             // Insert data ke database
             DB::table('sapaan_kepalas')->insert([
                 "sapaan" => $request->sapaan,
                 "gambar" => $gambarPath,
                 'created_at' => Carbon::now()
             ]);

             Alert::success('success', 'SAPAAN TELAH DIKIRIM!');
             return redirect()->route('admin.sapa.index');
         } catch (\Exception $e) {
             Alert::error('error', $e->getMessage());
             return redirect()->route('admin.sapa.index');
         }
     }
     public function updateSapaan(Request $request, $id)
     {
         try {
             // Validasi input
             $request->validate([
                 'sapaan' => 'required|string|max:255',
                 'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
             ]);

             $sapaan = DB::table('sapaan_kepalas')->where('id', $id)->first();
             $gambarPath = $sapaan->gambar; // Gunakan gambar lama sebagai default

             // Proses upload gambar baru jika ada
             if ($request->hasFile('gambar')) {
                 // Hapus gambar lama jika ada
                 if (!empty($sapaan->gambar) && file_exists(storage_path("app/public/{$sapaan->gambar}"))) {
                     unlink(storage_path("app/public/{$sapaan->gambar}"));
                 }

                 // Simpan gambar baru
                 $gambarPath = $request->file('gambar')->store('sapaan', 'public');
             }

             DB::table('sapaan_kepalas')->where('id', $id)->update([
                 "sapaan" => $request->sapaan,
                 "gambar" => $gambarPath,
                 "updated_at" => Carbon::now()
             ]);

             Alert::success('success', 'SAPAAN TELAH DIKIRIM!');
             return redirect()->route('admin.sapa.index');
         } catch (\Exception $e) {
             Alert::error('error', $e->getMessage());
             return redirect()->route('admin.sapa.index');
         }
     }

     public function destroySapaan(Request $request, $id)
     {
         try {
             $sapaan = DB::table('sapaan_kepalas')->where('id', $id)->first();

             // Hapus gambar jika ada
             if ($sapaan->gambar && file_exists(storage_path("app/public/{$sapaan->gambar}"))) {
                 unlink(storage_path("app/public/{$sapaan->gambar}"));
             }

             DB::table('sapaan_kepalas')->where('id', $id)->delete();

             Alert::success('success', 'SAPAAN TELAH DIHAPUS!');
             return redirect()->route('admin.sapa.index');
         } catch (\Exception $e) {
             Alert::error('error', $e->getMessage());
             return redirect()->route('admin.sapa.index');
         }
     }
}
