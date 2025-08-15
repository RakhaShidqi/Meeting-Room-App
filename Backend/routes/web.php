<?php

use App\Http\Controllers\RuanganController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/welcome', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('login');
});

Route::get('/home', function () {
    return view('admin.home');
});


Route::get('/akun', function () {
    return view('.admin.akun');
});

Route::get('/user-akun', function () {
    return view('.user.uakun');
});

Route::get('/register', function () {
    return view('register');
});


Route::get('/forgot-password', function () {
    return view('forgot-password');
});

// Route::get('/form-tambahruang', function () {
//     return view('.admin.form-tambahruang');
// });

Route::get('/jadwalpop', function () {
    return view('admin.jadwalpop');
});

Route::get('/log-activity', function () {
    return view('admin.logactivity');
});

Route::get('/admin/pending-requests', function () {
    return view('admin.req');
});

Route::get('/manage', function () {
    return view('admin.manage');
});

Route::get('/user-home', function () {
    return view('user.uhome');
});

// Login Page
Route::get('/login', [LoginController::class, 'view']);
Route::post('/login', [LoginController::class, 'login']);

// Sidebar Ruang Meeting
Route::get('/ruangan-meeting', [RuanganController::class, 'index'])->name('ruangan.index');
Route::get('/tambah-ruangan', [RuanganController::class, 'create'])->name('ruangan.create');
Route::post('/tambah-ruangan', [RuanganController::class, 'storeRuangan'])->name('ruangan.store');

// Form edit
Route::get('/ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');

// Proses update
Route::put('/ruangan/{id}', [RuanganController::class, 'update'])->name('ruangan.update');

Route::put('/ruangan-meeting/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
Route::get('/ruangan-meeting/{id}/booking', [BookingController::class, 'showBookingForm'])->name('ruangan.booking.form');
Route::post('/ruangan-meeting/{id}/booking', [BookingController::class, 'storeBookingForm'])->name('ruangan.booking.store');

// pending-req-booking
Route::get('/admin/pending-requests', [BookingController::class, 'waitingApproval'])->name('booking.waiting');
Route::patch('/booking/{id}/approve', [BookingController::class, 'approve'])->name('booking.approve');
Route::patch('/booking/{id}/reject', [BookingController::class, 'reject'])->name('booking.reject');

// Sidebar Jadwal
Route::get('/jadwal', [BookingController::class, 'jadwal'])->name('jadwal');
Route::get('/api/bookings/approved', [BookingController::class, 'getApprovedBookings']);


// Sidebar Log Activity

// Sidebar User Management
Route::get('/admin/user-management', [UserController::class, 'index'])->name('user.index');

