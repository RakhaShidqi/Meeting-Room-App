<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::all(); // ambil semua data dari tabel ruangan
        return view('ruangan-meeting', compact('ruangans'));
    }
}

?>