<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\GuruSiswaController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminBeritaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AdminArtikelController;
use App\Http\Controllers\AdminInformasiController;

// Landing Page Route
Route::view('/', 'welcome');

// Public Routes
Route::get('/', [BerandaController::class, 'index']);
Route::get('/visi-misi', [VisiMisiController::class, 'index']);
Route::get('/informasi', [InformasiController::class, 'index']);
Route::get('/galeri', [GaleriController::class, 'index']);
Route::get('/data', [DataController::class, 'index']);
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index'); // Public route for articles
Route::get('/kontak', [KontakController::class, 'index']);
Route::get('/pendaftaran', [PendaftaranController::class, 'index']);
Route::get('/berita', [BeritaController::class, 'index']); // Public route for berita
Route::get('/profil', [ProfilController::class, 'index']);
Route::get('/guru-siswa', [GuruSiswaController::class, 'index']);

// Artikel Publik - Show Individual Artikel
Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');

// Berita Publik
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');

// Informasi Publik
Route::get('/informasi/{id}', [InformasiController::class, 'show'])->name('informasi.show');



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


});

// Authentication Routes
require __DIR__.'/auth.php';
