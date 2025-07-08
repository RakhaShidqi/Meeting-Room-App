<?php

namespace App\Http\Controllers;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function create($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('form-editruang', compact('ruangan'));
    }
}
