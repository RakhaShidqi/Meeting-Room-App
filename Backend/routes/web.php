<?php

use App\Http\Controllers\RuanganController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UserController;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

// Middleware
// Hanya admin bisa lihat daftar user
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/home', [DashboardController::class, 'adminHome'])->name('admin.home');
});

// Hanya user
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/home', [DashboardController::class, 'userHome'])->name('user.uhome');
});

Route::get('/logtest', function () {
    Log::info("✅ Test log masuk");
    return "Cek log di storage/logs/laravel.log";
});


// Tampilan Admin
// Route::get('/akun', function () {
//     return view('.admin.akun')->name('admin.akun');
// });

// Route::get('/admin/pending-requests', function () {
//     return view('admin.req');
// })->name('pending-request');

Route::get('/manage', function () {
    return view('admin.manage');
});

// Register Page
Route::get('/register', [RegisterController::class,'view'])->name('register');
Route::post('/register-account', [RegisterController::class,'register'])->name('register.post');

// Sidebar Akun saya
Route::get('/admin/akun', [UserController::class, 'akun'])->name('admin.akun');

// Form edit
Route::get('/ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');

// Proses update
Route::put('/ruangan/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
Route::put('/ruangan-meeting/{id}', [RuanganController::class, 'update'])->name('ruangan.update');

// proses Deleted
Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');



// Tampilan User
Route::get('/user-akun', function () {
    return view('.user.uakun');
});

Route::get('/user-log', function () {
    return view('user.ulogactivity');
});

// Global Page
// Login Page
Route::get('/', [LoginController::class, 'view'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Forgot Password
Route::get('/forgot-password', function () {
    return view('forgot-password');
});

// Sidebar Ruang Meeting
Route::get('/ruangan-meeting', [RuanganController::class, 'index'])->name('ruangan.index');
Route::get('/tambah-ruangan', [RuanganController::class, 'create'])->name('ruangan.create');
Route::post('/tambah-ruangan', [RuanganController::class, 'storeRuangan'])->name('ruangan.store');

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
Route::get('/admin/activity-log', [ActivityLogController::class, 'index'])->name('admin.activity-log');

// Sidebar User Management
Route::get('/admin/user-management', [UserController::class, 'index'])->name('user.index');
Route::post('admin/user-management/addUser', [UserController::class, 'storeuser'])->name('users.store');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');




