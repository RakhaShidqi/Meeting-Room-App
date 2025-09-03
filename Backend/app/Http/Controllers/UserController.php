<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan semua user (hanya admin yang bisa akses)
    public function index()
    {
        $users = User::all();
        return view('admin.manage', compact('users'));
    }

    // Dashboard untuk admin
    public function adminHome()
    {
        return view('admin.home');
    }

    // Dashboard untuk customer
    public function userHome()
    {
        return view('user.uhome');
    }
}
