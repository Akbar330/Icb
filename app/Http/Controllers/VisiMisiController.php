<?php

namespace App\Http\Controllers;

use App\Models\Visi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    //
    public function index() {
        $visiMisi = Visi::first();
        return view('visi-misi.index', compact('visiMisi'));
    }
}
