<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Masyarakat\DashboardController;
use App\Http\Controllers\Masyarakat\PengaduanController; 
// INCREMENTAL REVISI: Menambahkan import PetugasController tanpa mengganggu import di atas
use App\Http\Controllers\Petugas\PetugasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingpage');
});

// Auth
Route::get('/login', [AuthController::class, 'toLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', function () {
    return view('Auth.register');
})->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('registerProses');

// Ubah dari Route::get menjadi Route::post agar klop dengan form logout di navbar light mode
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/admin', function () {
    return "Dashboard Admin";
});

// NOTE: Route::get('/petugas') lama berupa fungsi closure string telah dikomentari / diganti di bawah
// agar sinkron dengan sistem pengalihan halaman dashboard petugas asli.

// Grup Rute Terautentikasi (Masyarakat & Petugas)
Route::middleware(['auth'])->group(function () { 
    
    // ==========================================
    // Modul Masyarakat (Tetap Utuh & Berjalan)
    // ==========================================
    Route::get('/masyarakat', [DashboardController::class, 'index'])->name('masyarakat.dashboard');
    
    // Fitur Pengaduan Masyarakat
    Route::get('/masyarakat/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/masyarakat/pengaduan/store', [PengaduanController::class, 'store'])->name('pengaduan.store');
    
    // REVISI: Menambahkan rute halaman riwayat pengaduan masyarakat
    Route::get('/masyarakat/pengaduan/riwayat', [PengaduanController::class, 'riwayat'])->name('pengaduan.riwayat');

    // REVISI TERBARU: Menambahkan rute halaman daftar berita untuk masyarakat
    Route::get('/masyarakat/berita', [DashboardController::class, 'berita'])->name('masyarakat.berita');


    // ==========================================
    // Modul Petugas / Staff (Fitur Baru)
    // ==========================================
    // Mengarahkan URL /petugas ke halaman dashboard utama petugas berbasis database
    Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.dashboard');
    
    // Mengarahkan ke halaman tabel daftar pengaduan masyarakat untuk divalidasi petugas
    Route::get('/petugas/pengaduan', [PetugasController::class, 'pengaduanIndex'])->name('petugas.pengaduan.index');

    // REVISI TERBARU STAFF: Rute untuk Detail Pengaduan & Form Pengisian Feedback
    Route::get('/petugas/pengaduan/detail/{id}', [PetugasController::class, 'pengaduanDetail'])->name('petugas.pengaduan.detail');
    
    // REVISI TERBARU STAFF: Rute untuk Memproses & Menyimpan Feedback/Tanggapan Petugas
    Route::post('/petugas/pengaduan/tanggapan/{id}', [PetugasController::class, 'beriTanggapan'])->name('petugas.tanggapan.store');
    
    // REVISI TERBARU STAFF: Halaman Riwayat Kerja Feedback Seluruh Masyarakat + Filter Rentang Tanggal
    Route::get('/petugas/riwayat-feedback', [PetugasController::class, 'riwayatFeedback'])->name('petugas.riwayat.index');
});