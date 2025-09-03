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
        $user = Auth::user();

        // cek role
        if ($user->role === 'admin') {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('user.uhome'); // default untuk user
        }
    }

        // Jika gagal login
        return back()->withErrors(['email' => 'Email atau password anda salah']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
