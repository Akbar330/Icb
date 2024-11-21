<?php

namespace App\Http\Controllers;

use App\Models\Oncam;
use Illuminate\Http\Request;

class OncamController extends Controller
{
    //
    public function index() {
        $oncams = Oncam::all();
        return view('admin.oncam.index', compact('oncams'));
    }

    public function create() {
        return view('admin.oncam.create');
    }

    public function store(Request $request) {
        // Embed Link Validate
        $request->validate([
            'embed_link' => 'required'
        ]);
    }
}
