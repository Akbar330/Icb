<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OncamController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\GuruSiswaController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\AdminOncamController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminBeritaController;
use App\Http\Controllers\AdminGaleriController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AdminArtikelController;
use App\Http\Controllers\AdminInformasiController;
use App\Http\Controllers\AdminPendaftaranController;

// Landing Page Route
Route::view('/', 'welcome');

// Public Routes
Route::get('/', [BerandaController::class, 'index']);
Route::get('/visi-misi', [VisiMisiController::class, 'index']);
Route::get('/informasi', [InformasiController::class, 'index']);
Route::get('/galeri', [GaleriController::class, 'index']);
Route::get('/data', [DataController::class, 'index']);
Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.index');
 // Public route for articles
Route::get('/kontak', [KontakController::class, 'index']);
Route::get('/pendaftaran', [PendaftaranController::class, 'index']);
Route::get('/berita', [BeritaController::class, 'index']); // Public route for berita
Route::get('/profil', [ProfilController::class, 'index']);
Route::get('/guru-siswa', [GuruSiswaController::class, 'index']);

// Artikel Publik - Show Individual Artikel
Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');

Route::get('/artikel-search', [ArtikelController::class, 'search'])->name('artikel.search');

// Berita Publik
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');

// Informasi Publik
Route::get('/informasi/{id}', [InformasiController::class, 'show'])->name('informasi.show');

// Pendaftaran
Route::resource('pendaftaran', PendaftaranController::class);
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::get('/pendaftaran/success', [PendaftaranController::class, 'success'])->name('pendaftaran.success');


// Auth Routes
Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');
Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

// Admin Routes
Route::prefix('admin')->middleware('auth')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    // Authentication Routes for Admin
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Admin Artikel Routes
    Route::get('/artikel', [AdminArtikelController::class, 'index'])->name('admin.artikel.index');
    Route::get('/artikel/create', [AdminArtikelController::class, 'create'])->name('admin.artikel.create');
    Route::post('/artikel', [AdminArtikelController::class, 'store'])->name('admin.artikel.store');
    Route::get('/artikel/{artikel}/edit', [AdminArtikelController::class, 'edit'])->name('admin.artikel.edit');
    Route::put('/artikel/{artikel}', [AdminArtikelController::class, 'update'])->name('admin.artikel.update');
    Route::delete('/artikel/{artikel}', [AdminArtikelController::class, 'destroy'])->name('admin.artikel.destroy');

    // Admin Berita Routes
    Route::get('/berita', [AdminBeritaController::class, 'index'])->name('admin.berita.index');
    Route::get('/berita/create', [AdminBeritaController::class, 'create'])->name('admin.berita.create');
    Route::post('/berita', [AdminBeritaController::class, 'store'])->name('admin.berita.store');
    Route::get('/berita/{berita}/edit', [AdminBeritaController::class, 'edit'])->name('admin.berita.edit');
    Route::put('/berita/{berita}', [AdminBeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/berita/{berita}', [AdminBeritaController::class, 'destroy'])->name('admin.berita.destroy');

    // Admin Informasi Routes
    Route::get('/informasi', [AdminInformasiController::class, 'index'])->name('admin.info.index');
    Route::get('/informasi/create', [AdminInformasiController::class, 'create'])->name('admin.info.create');
    Route::post('/informasi', [AdminInformasiController::class, 'store'])->name('admin.info.store');
    Route::get('/informasi/{informasi}/edit', [AdminInformasiController::class, 'edit'])->name('admin.info.edit');
    Route::put('/informasi/{informasi}', [AdminInformasiController::class, 'update'])->name('admin.info.update');
    Route::delete('/informasi/{informasi}', [AdminInformasiController::class, 'destroy'])->name('admin.info.destroy');
    Route::put('/admin/informasi/{id}', [InformasiController::class, 'update'])->name('admin.informasi.update');
    Route::delete('/admin/informasi/{id}', [InformasiController::class, 'destroy'])->name('admin.informasi.destroy');

    // Oncam
    Route::get('/oncam', [AdminOncamController::class, 'index'])->name('oncam.index');
    Route::get('/oncam/create', [AdminOncamController::class, 'create'])->name('oncam.create');
    Route::get('/oncam/edit', [AdminOncamController::class, 'edit'])->name('oncam.edit');
    Route::get('/oncam/{oncam}', [AdminOncamController::class, 'destroy'])->name('oncam.destroy');
    Route::post('/oncam', [AdminOncamController::class, 'store'])->name('oncam.store');

    // Admin PPDB
    Route::get('/pendaftaran', [AdminPendaftaranController::class, 'index'])->name('admin.pendaftaran.index');
    Route::get('/pendaftaran/{id}', [AdminPendaftaranController::class, 'show'])->name('admin.pendaftaran.show');


    // Admin Galeri
    Route::get('/galeri', [AdminGaleriController::class, 'index'])->name('admin.galeri.index');

    // Route untuk menampilkan form upload gambar (GET)
    Route::get('/galeri/create', [AdminGaleriController::class, 'create'])->name('admin.galeri.create');

    Route::get('/carousel', [CarouselController::class, 'index'])->name('admin.carousel.index');
    Route::get('/carousel/create', [CarouselController::class, 'create'])->name('admin.carousel.create');
    Route::post('/carousel/store', [CarouselController::class, 'store'])->name('admin.carousel.store');
    Route::get('/carousel/{carousel}/edit', [CarouselController::class, 'edit'])->name('admin.carousel.edit');
    Route::put('/carousel/{carousel}', [CarouselController::class, 'update'])->name('admin.carousel.update');
    Route::delete('/carousel/{carousel}', [CarouselController::class, 'destroy'])->name('admin.carousel.destroy');

    //EXPORT
    Route::get('/admin/pendaftaran/export-excel', [AdminPendaftaranController::class, 'exportExcel'])->name('admin.pendaftaran.exportExcel');
    Route::get('/admin/pendaftaran/export-pdf', [AdminPendaftaranController::class, 'exportPdf'])->name('admin.pendaftaran.exportPdf');
    Route::get('/admin/pendaftaran/search', [AdminPendaftaranController::class, 'search'])->name('admin.pendaftaran.search');

    Route::get('/admin/artikel/export-excel', [AdminartikelController::class, 'exportExcel'])->name('admin.artikel.exportExcel');
    Route::get('/admin/artikel/export-pdf', [AdminartikelController::class, 'exportPdf'])->name('admin.artikel.exportPdf');
    Route::get('/admin/artikel/search', [AdminartikelController::class, 'search'])->name('admin.artikel.search');

    Route::get('/admin/berita/export-excel', [AdminBeritaController::class, 'exportExcel'])->name('admin.berita.exportExcel');
    Route::get('/admin/berita/export-pdf', [AdminBeritaController::class, 'exportPdf'])->name('admin.berita.exportPdf');
    Route::get('/admin/berita/search', [AdminBeritaController::class, 'search'])->name('admin.berita.search');

});

// Authentication Routes
require __DIR__.'/auth.php';
