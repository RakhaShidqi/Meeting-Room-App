<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ruangan;

class DashboardController extends Controller
{
    // Dashboard untuk admin
   public function adminHome()
{
    // Hitung total ruangan
    $totalRuangans = DB::table('ruangans')->count();

    // Hitung total booking yang sudah di-approve
    $approvedBookings = DB::table('bookings')
        ->where('status', 'approved')
        ->count();

    // Hitung Total Booking yg di reject
    $rejectedBookings = DB::table('bookings')
        ->where('status', 'rejected')
        ->count();

    // Kirim keduanya ke view
    return view('admin.home', compact('totalRuangans', 'approvedBookings', 'rejectedBookings'));
}


    // Dashboard untuk customer
    public function userHome()
    {
        return view('user.uhome');
    }
}
