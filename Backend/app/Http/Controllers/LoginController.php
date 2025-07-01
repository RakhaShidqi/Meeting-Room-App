<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 

class LoginController extends Controller
{
    public function view()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi Input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek Kredensial
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/home');
        }

        // Jika gagal
        return back()->withErrors(['email' => 'Email atau password anda salah']);
    }
}
