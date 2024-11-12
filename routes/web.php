<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\GuruSiswaController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\PendaftaranController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/', [BerandaController::class, 'index']);
Route::get('/visi-misi', [VisiMisiController::class, 'index']);
Route::get('/informasi', [InformasiController::class, 'index']);
Route::get('/galeri', [GaleriController::class, 'index']);
Route::get('/data', [DataController::class, 'index']);
Route::get('/artikel', [ArtikelController::class, 'index']);
Route::get('/kontak', [KontakController::class, 'index']);
Route::get('/pendaftaran', [PendaftaranController::class, 'index']);
Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/profil', [ProfilController::class, 'index']);
Route::get('/guru-siswa', [GuruSiswaController::class, 'index']);
// Tambahkan route lain sesuai halaman yang Anda buat
require __DIR__.'/auth.php';
