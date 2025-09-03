<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ActivityLogHelper;
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

  // ✅ log activity: login sukses
        ActivityLogHelper::add('Login', 'Berhasil login dengan email: ' . $user->email);

        // cek role
        if ($user->role === 'admin') {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('user.uhome'); // default untuk user
        }
    }
        // ✅ log activity untuk login gagal
        ActivityLogHelper::add('Login Gagal', 'Email: ' . $request->email);

        // Jika gagal login
        return back()->withErrors(['email' => 'Email atau password anda salah']);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            ActivityLogHelper::add('Logout', 'User: ' . $user->email . ' Log Out');
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
