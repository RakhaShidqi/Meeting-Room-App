<?php

namespace App\Http\Controllers;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('formbooking', compact('ruangan'));
    }
}
