<?php

use App\Http\Controllers\RuanganController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('login');
});

Route::get('/home', function () {
    return view('home');
});

// Route::get('/ruangan-meeting', function () {
//     return view('ruangan-meeting');
// });

Route::get('/jadwal', function () {
    return view('jadwal');
});

Route::get('/akun', function () {
    return view('akun');
});

Route::get('/register', function () {
    return view('register');
});


Route::get('/forgot-password', function () {
    return view('forgot-password');
});

Route::get('/form-tambahruang', function () {
    return view('form-tambahruang');
});

Route::get('/form-editruang', function () {
    return view('form-editruang');
});

Route::get('/jadwalpop', function () {
    return view('jadwalpop');
});

Route::get('/logactivity', function () {
    return view('logactivity');
});

Route::get('/login', [LoginController::class, 'view']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/ruangan-meeting', [RuanganController::class, 'index'])->name('ruangan.index');
Route::get('/form-booking/{id}/{nama?}', [BookingController::class, 'create'])->name('form.pemesanan');
