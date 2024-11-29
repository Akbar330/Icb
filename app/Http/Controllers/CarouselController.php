<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carousel;
use Illuminate\Support\Facades\Storage;
class CarouselController extends Controller
{
    /**
     * Tampilkan daftar carousel.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil semua data carousel yang diurutkan berdasarkan 'order'
        $carousels = Carousel::orderBy('order')->get();

        return view('admin.carousel.index', compact('carousels'));
    }

    /**
     * Tampilkan form untuk membuat carousel baru.
     *
     * @return \Illuminate\View\View
     */
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
        // Validasi data yang diterima
        $validated = $request->validate([
            'order' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:50000',
        ]);

        // Tentukan path penyimpanan
        $imagePath = $request->file('image')->store('images/carousel', 'public');

        // Simpan data ke database
        Carousel::create([
            'order' => $validated['order'],
            'image_path' => $imagePath, // Menyimpan path gambar ke kolom 'image_path'
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.carousel.index')->with('success', 'Carousel created successfully.');
    }


    /**
     * Tampilkan form untuk mengedit carousel.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $carousel = Carousel::findOrFail($id);
        return view('admin.carousel.edit', compact('carousel'));
    }

    /**
     * Update data carousel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

public function update(Request $request, $id)
{
    $carousel = Carousel::findOrFail($id);

    // Validasi input
    $request->validate([
        'order' => 'required|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:50000',
    ]);

    // Update order
    $carousel->order = $request->order;

    // Update image jika ada
    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($carousel->image_path) {
            Storage::delete('public/' . $carousel->image_path);
        }

        // Simpan gambar baru
        $imagePath = $request->file('image')->store('images/carousel', 'public');
        $carousel->image_path = $imagePath; // Simpan path gambar baru ke kolom 'image_path'
    }

    $carousel->save();

    return redirect()->route('admin.carousel.index')->with('success', 'Carousel updated successfully');
}

    /**
     * Hapus carousel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $carousel = Carousel::findOrFail($id);

        // Hapus gambar dari storage
        if ($carousel->image) {
            Storage::delete('public/' . $carousel->image);
        }

        // Hapus data carousel dari database
        $carousel->delete();

        return redirect()->route('admin.carousel.index')->with('success', 'Carousel deleted successfully');
    }
}
