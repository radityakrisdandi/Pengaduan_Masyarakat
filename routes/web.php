<?php

use App\Http\Controllers\Auth\AuthController;
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


Route::get('/admin', function () {
    return "Dashboard Admin";
});

Route::get('/petugas', function () {
    return "Dashboard Petugas";
});

Route::get('/user', function () {
    return "Dashboard User";
});

