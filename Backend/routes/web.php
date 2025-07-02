<?php

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

Route::get('/ruang-meeting', function () {
    return view('ruang-meeting');
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

Route::get('/formbooking', function () {
    return view('formbooking');
});

Route::get('/login', [LoginController::class, 'view']);
Route::post('/login', [LoginController::class, 'login']);
