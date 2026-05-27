<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Masyarakat\DashboardController;
use App\Http\Controllers\Masyarakat\PengaduanController;
// INCREMENTAL REVISI: Menambahkan import PetugasController tanpa mengganggu import di atas
use App\Http\Controllers\Petugas\PetugasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PengaduanController as AdminPengaduanController;
use App\Http\Controllers\Admin\KategoriController as AdminKategoriController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Petugas\BeritaController as PetugasBeritaController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\LogAktivitasController;

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


// ==========================================
// Modul Admin
// ==========================================

Route::get('/admin', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard');

Route::get('/admin/pengaduan', [AdminPengaduanController::class, 'index'])
    ->name('admin.pengaduan.index');

Route::post(
    '/admin/kategori/store',
    [AdminPengaduanController::class, 'storeKategori']
)
    ->name('admin.kategori.store');

Route::delete(
    '/admin/kategori/{id}/delete',
    [AdminPengaduanController::class, 'destroyKategori']
)
    ->name('admin.kategori.destroy');

Route::get(
    '/admin/user',
    [AdminUserController::class, 'index']
)
    ->name('admin.user.index');

Route::put(
    '/admin/user/{id}/role',
    [AdminUserController::class, 'updateRole']
)
    ->name('admin.user.role');

Route::delete(
    '/admin/user/{id}/delete',
    [AdminUserController::class, 'destroy']
)
    ->name('admin.user.destroy');

Route::get(
    '/admin/berita',
    [AdminBeritaController::class, 'index']
)
    ->name('admin.berita.index');

Route::post(
    '/admin/berita/store',
    [AdminBeritaController::class, 'store']
)
    ->name('admin.berita.store');

Route::put(
    '/admin/berita/{id}/update',
    [AdminBeritaController::class, 'update']
)
    ->name('admin.berita.update');

Route::delete(
    '/admin/berita/{id}/delete',
    [AdminBeritaController::class, 'destroy']
)
    ->name('admin.berita.destroy');

// ==========================================
// Grup Rute Terautentikasi (Masyarakat & Petugas)
// ==========================================
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
    // Modul Petugas / Staff (Fitur Berita & Pengaduan)
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

    // Rute Kelola Berita Sisi Petugas
    Route::get('/petugas/berita', [PetugasBeritaController::class, 'index'])->name('petugas.berita.index');
    Route::post('/petugas/berita/store', [PetugasBeritaController::class, 'store'])->name('petugas.berita.store');

    // REVISI BARU: Ditambahkan agar AJAX Modal Edit dan Form Update Petugas Berjalan Lancar
    Route::get('/petugas/berita/{id}/edit', [PetugasBeritaController::class, 'edit'])->name('petugas.berita.edit');
    Route::put('/petugas/berita/{id}', [PetugasBeritaController::class, 'update'])->name('petugas.berita.update');

    Route::delete('/petugas/berita/{id}/delete', [PetugasBeritaController::class, 'destroy'])->name('petugas.berita.destroy');


    // Aksi Modifikasi Pengaduan Masyarakat
    Route::get('/masyarakat/pengaduan/{id}/edit', [PengaduanController::class, 'edit'])
        ->name('pengaduan.edit');

    Route::put('/masyarakat/pengaduan/{id}/update', [PengaduanController::class, 'update'])
        ->name('pengaduan.update');

    Route::delete('/masyarakat/pengaduan/{id}/delete', [PengaduanController::class, 'destroy'])
        ->name('pengaduan.destroy');

    Route::get(
        '/admin/log-aktivitas',
        [LogAktivitasController::class, 'index']
    )
        ->name('admin.log.index');
    Route::get(
        '/petugas/log-aktivitas',
        [LogAktivitasController::class, 'index']
    )
        ->name('petugas.log.index');
    Route::get(
        '/masyarakat/log-aktivitas',
        [LogAktivitasController::class, 'index']
    )
        ->name('masyarakat.log.index');
        
});
