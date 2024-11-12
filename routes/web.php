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
use App\Http\Controllers\AdminBeritaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AdminArtikelController;
use App\Http\Controllers\Auth\LoginController;




Route::view('/', 'welcome');

// Public Routes
Route::get('/', [BerandaController::class, 'index']);
Route::get('/visi-misi', [VisiMisiController::class, 'index']);
Route::get('/informasi', [InformasiController::class, 'index']);
Route::get('/galeri', [GaleriController::class, 'index']);
Route::get('/data', [DataController::class, 'index']);
Route::get('/artikel', [ArtikelController::class, 'index']); // Public route for articles
Route::get('/kontak', [KontakController::class, 'index']);
Route::get('/pendaftaran', [PendaftaranController::class, 'index']);
Route::get('/berita', [BeritaController::class, 'index']); // Public route for berita
Route::get('/profil', [ProfilController::class, 'index']);
Route::get('/guru-siswa', [GuruSiswaController::class, 'index']);

// Auth Routes
Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');
Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

// Admin Routes
Route::prefix('admin')->middleware('auth')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Artikel Routes
    Route::get('/artikel', [AdminArtikelController::class, 'index'])->name('admin.artikel.index'); // Admin route for articles
    Route::get('/artikel/create', [AdminArtikelController::class, 'create'])->name('admin.artikel.create'); // Admin route for creating article
    Route::post('/artikel', [AdminArtikelController::class, 'store'])->name('admin.artikel.store');
    Route::get('/artikel/{artikel}/edit', [AdminArtikelController::class, 'edit'])->name('admin.artikel.edit');
    Route::put('/artikel/{artikel}', [AdminArtikelController::class, 'update'])->name('admin.artikel.update');
    Route::delete('/artikel/{artikel}', [AdminArtikelController::class, 'destroy'])->name('admin.artikel.destroy');

    // Berita Routes
    Route::get('/berita', [AdminBeritaController::class, 'index'])->name('admin.berita.index'); // Admin route for berita
    Route::get('/berita/create', [AdminBeritaController::class, 'create'])->name('admin.berita.create'); // Admin route for creating berita
    Route::post('/berita', [AdminBeritaController::class, 'store'])->name('admin.berita.store');
    Route::get('/berita/{berita}/edit', [AdminBeritaController::class, 'edit'])->name('admin.berita.edit');
    Route::put('/berita/{berita}', [AdminBeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/berita/{berita}', [AdminBeritaController::class, 'destroy'])->name('admin.berita.destroy');

});

require __DIR__.'/auth.php';


