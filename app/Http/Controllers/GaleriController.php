<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
class GaleriController extends Controller
{
    //
    public function index() {
        $gambarGaleri = Galeri::paginate(12);
        return view('galeri.index', compact('gambarGaleri'));
    }
}
