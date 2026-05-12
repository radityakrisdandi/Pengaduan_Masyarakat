<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Masyarakat\DashboardController;
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
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('/test', function() {
//     return view('layout.app');
// });


Route::get('/admin', function () {
    return "Dashboard Admin";
});

Route::get('/petugas', function () {
    return "Dashboard Petugas";
});

Route::get('/masyarakat', [DashboardController::class, 'index'])->name('masyarakat.dashboard');
