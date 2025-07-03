<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create($id)
    {
        $ruangan = Ruangan::all();
        return view('formbooking', compact('ruangan'));
    }
}
