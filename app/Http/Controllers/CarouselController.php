<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carousel;

class CarouselController extends Controller
{
    /**
     * Tampilkan form untuk membuat carousel baru.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {   $carousels = Carousel::all();
        return view('admin.carousel.index', compact('carousels'));
    }
     public function create()
    {
        return view('admin.carousel.create'); // Pastikan file view 'carousel.create' ada
    }

    /**
     * Simpan data carousel baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order' => 'required|integer|min:0',
        ]);

        Carousel::create($validated);

        return redirect()->route('admin.carousel.index')->with('success', 'Carousel created successfully.');
    }
}
