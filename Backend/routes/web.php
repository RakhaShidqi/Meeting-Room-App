<?php

use App\Http\Controllers\RuanganController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EditController;
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

Route::get('/jadwalpop', function () {
    return view('jadwalpop');
});

Route::get('/log-activity', function () {
    return view('logactivity');
});

Route::get('/req', function () {
    return view('req');
});

Route::get('/manage', function () {
    return view('manage');
});

Route::get('/login', [LoginController::class, 'view']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('/ruangan-meeting', [RuanganController::class, 'index'])->name('ruangan.index');
Route::get('/tambah-ruangan', [RuanganController::class, 'create'])->name('ruangan.create');
Route::post('/tambah-ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
Route::get('/ruangan-meeting/{id}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');
Route::put('/ruangan-meeting/{id}', [RuanganController::class, 'update'])->name('ruangan.update');

Route::get('/ruangan-meeting/{id}/booking', [RuanganController::class, 'showBookingForm'])->name('ruangan.booking.form');
Route::post('/ruangan-meeting/{id}/booking', [RuanganController::class, 'storeBooking'])->name('ruangan.booking.store');