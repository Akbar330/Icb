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
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\GuruSiswaController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KepsekController;
use App\Http\Controllers\AdminOncamController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminBeritaController;
use App\Http\Controllers\AdminGaleriController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AdminArtikelController;
use App\Http\Controllers\BiayaSekolahController;
use App\Http\Controllers\AdminInformasiController;
use App\Http\Controllers\AdminPendaftaranController;
use App\Http\Controllers\AdminBiayaSekolahController;
use App\Http\Controllers\AdminVisiController;
use App\Http\Controllers\PollingController;
use App\Http\Controllers\SapaanController;
use App\Http\Controllers\UserManagementController;

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
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
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

// Biaya
Route::get('/biaya', [BiayaSekolahController::class, 'index']);
// kirim vote
Route::post('/vote', [PollingController::class, 'vote'])->name('vote.store');

// Auth Routes
Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');
Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

// Admin Routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    // Authentication Routes for Admin
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

    // Admin Informasi Routes
    Route::get('/kepsek', [KepsekController::class, 'index'])->name('admin.kepsek.index');
    Route::get('/kepsek/create', [KepsekController::class, 'create'])->name('admin.kepsek.create');
    Route::post('/kepsek', [KepsekController::class, 'store'])->name('admin.kepsek.store');
    Route::get('/kepsek/{kepsek}/edit', [KepsekController::class, 'edit'])->name('admin.kepsek.edit');
    Route::put('/kepsek/{kepsek}', [KepsekController::class, 'update'])->name('admin.kepsek.update');
    Route::delete('/kepsek/{kepsek}', [KepsekController::class, 'destroy'])->name('admin.kepsek.destroy');

    // Admin Visi Misi
    Route::get('/visi', [AdminVisiController::class, 'index'])->name('admin.visi.index');
    Route::get('/visi/create', [AdminVisiController::class, 'create'])->name('admin.visi.create');
    Route::post('/visi', [AdminVisiController::class, 'store'])->name('admin.visi.store');
    Route::get('/visi/{visi}/edit', [AdminVisiController::class, 'edit'])->name('admin.visi.edit');
    Route::put('/visi/{visi}', [AdminVisiController::class, 'update'])->name('admin.visi.update');
    Route::delete('/visi/{visi}', [AdminVisiController::class, 'destroy'])->name('admin.visi.destroy');
    // Admin Polling
    Route::get('/polling', [PollingController::class, 'index'])->name('admin.polling.index');
    Route::get('/polling/create', [PollingController::class, 'create'])->name('admin.polling.create');
    Route::post('/polling/add-polling', [PollingController::class, 'store'])->name('admin.polling.store');

    // Specific Routes First
    Route::put('/polling/status/{id}', [PollingController::class, 'changeStatusShow'])->name('admin.polling.changeStatusShow');
    Route::delete('/polling/delete/{id}', [PollingController::class, 'destroy'])->name('admin.polling.destroy');
    
    // More General Routes Later
    Route::get('/polling/edit/{id}', [PollingController::class, 'edit'])->name('admin.polling.edit');
    Route::put('/polling/update/{id}', [PollingController::class, 'update'])->name('admin.polling.update');



    // Oncam
    // Daftar Oncam
    Route::get('/oncam', [AdminOncamController::class, 'index'])->name('oncam.index');

    // Form untuk menambah Oncam
    Route::get('/oncam/create', [AdminOncamController::class, 'create'])->name('oncam.create');

    // Menyimpan Oncam
    Route::post('/oncam', [AdminOncamController::class, 'store'])->name('oncam.store');

    // Form untuk mengedit Oncam
    Route::get('/oncam/{id}/edit', [AdminOncamController::class, 'edit'])->name('oncam.edit');

    // Menyimpan perubahan Oncam
    Route::put('/oncam/{id}', [AdminOncamController::class, 'update'])->name('oncam.update');

    // Menghapus data Oncam
    Route::delete('/oncam/{id}', [AdminOncamController::class, 'destroy'])->name('oncam.destroy');

    // Admin PPDB
    Route::get('/pendaftaran', [AdminPendaftaranController::class, 'index'])->name('admin.pendaftaran.index');
    Route::get('/pendaftaran/{id}', [AdminPendaftaranController::class, 'show'])->name('admin.pendaftaran.show');

    // Admin Biaya
    Route::get('/biaya', [AdminBiayaSekolahController::class, 'index'])->name('admin.biaya.index');

    // Menampilkan form untuk menambah biaya sekolah
    Route::get('/biaya/create', [AdminBiayaSekolahController::class, 'create'])->name('admin.biaya.create');

    // Menyimpan biaya sekolah yang baru
    Route::post('/biaya', [AdminBiayaSekolahController::class, 'store'])->name('admin.biaya.store');

    // Menampilkan form untuk mengedit biaya sekolah
    Route::get('/biaya/{id}/edit', [AdminBiayaSekolahController::class, 'edit'])->name('admin.biaya.edit');

    // Memperbarui data biaya sekolah
    Route::put('/biaya/{id}', [AdminBiayaSekolahController::class, 'update'])->name('admin.biaya.update');

    // Menghapus biaya sekolah
    Route::delete('/biaya/{id}', [AdminBiayaSekolahController::class, 'destroy'])->name('admin.biaya.destroy');

    // Galeri
    Route::get('/galeri', [AdminGaleriController::class, 'index'])->name('admin.galeri.index');

    // Menampilkan form upload gambar
    Route::get('/galeri/create', [AdminGaleriController::class, 'create'])->name('admin.galeri.create');

    // Menyimpan gambar yang diunggah
    Route::post('/galeri', [AdminGaleriController::class, 'store'])->name('admin.galeri.store');

    // Sapaan Kepsek
    Route::get('/sapaan', [SapaanController::class, 'index'])->name('admin.sapa.index');
    Route::get('/sapaan/create', [SapaanController::class, 'create'])->name('admin.sapa.create');
    Route::post('/sapaan', [SapaanController::class, 'storeSapaan'])->name('admin.sapa.store');
    Route::get('/sapaan/edit/{id}', [SapaanController::class, 'editSapaan'])->name('admin.sapa.edit');
    Route::put('/sapaan/{id}', [SapaanController::class, 'updateSapaan'])->name('admin.sapa.update');
    Route::delete('/sapaan/{id}', [SapaanController::class, 'destroySapaan'])->name('admin.sapa.destroy');

    Route::get('/carousel', [CarouselController::class, 'index'])->name('admin.carousel.index');
    Route::get('/carousel/create', [CarouselController::class, 'create'])->name('admin.carousel.create');
    Route::post('/carousel/store', [CarouselController::class, 'store'])->name('admin.carousel.store');
    Route::get('/carousel/{carousel}/edit', [CarouselController::class, 'edit'])->name('admin.carousel.edit');
    Route::put('/carousel/{carousel}', [CarouselController::class, 'update'])->name('admin.carousel.update');
    Route::delete('/carousel/{carousel}', [CarouselController::class, 'destroy'])->name('admin.carousel.destroy');

    // Users Management
    Route::get('/pengguna', [UserManagementController::class, 'index'])->name('admin.pengguna.index');
    Route::get('/pengguna/tambah', [UserManagementController::class, 'create'])->name('admin.pengguna.create');
    Route::post('/pengguna', [UserManagementController::class, 'addUser'])->name('admin.pengguna.store');
    Route::get('/pengguna/edit/{id}', [UserManagementController::class, 'edit'])->name('admin.pengguna.edit');
    Route::put('/pengguna/{id}', [UserManagementController::class, 'editUser'])->name('admin.pengguna.update');
    Route::delete('/pengguna/{id}', [UserManagementController::class, 'deleteUser'])->name('admin.pengguna.destroy');

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
require __DIR__ . '/auth.php';
