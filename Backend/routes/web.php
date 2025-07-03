<?php
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\PemesananController;
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

Route::get('/formbooking', function () {
    return view('formbooking');
});

Route::get('/formbooking2', function () {
    return view('formbooking2');
});

Route::get('/formbooking3', function () {
    return view('formbooking3');
});

Route::get('/formbooking4', function () {
    return view('formbooking4');
});

Route::get('/formbooking5', function () {
    return view('formbooking5');
});

Route::get('/formbooking6', function () {
    return view('formbooking6');
});

Route::get('/formbooking7', function () {
    return view('formbooking7');
});

Route::get('/formbooking8', function () {
    return view('formbooking8');
});

Route::get('/formbooking9', function () {
    return view('formbooking9');
});

Route::get('/formbooking10', function () {
    return view('formbooking10');
});

Route::get('/formbooking11', function () {
    return view('formbooking11');
});

Route::get('/formbooking12', function () {
    return view('formbooking12');
});

Route::get('/formbooking13', function () {
    return view('formbooking13');
});

Route::get('/login', [LoginController::class, 'view']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/form-pemesanan/{id}', [PemesananController::class, 'create'])->name('form.pemesanan');
Route::get('/ruangan-meeting', [RuanganController::class, 'index'])->name('ruangan.index');