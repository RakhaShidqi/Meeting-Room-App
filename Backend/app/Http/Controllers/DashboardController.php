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
        $totalRuangans = DB::table('ruangans')->count();
        return view('admin.home', compact('totalRuangans'));
    }

    // Dashboard untuk customer
    public function userHome()
    {
        return view('user.uhome');
    }
}
