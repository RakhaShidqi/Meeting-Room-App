<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function view()
    {
        Log::info("📌 Masuk ke method view()");
        return view("admin.register");
    }

    public function register(Request $request)
    {
        Log::info("📌 Masuk ke method register()", $request->all());

        try {
            $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);
            Log::info("✅ Validasi sukses");

            $user = User::create([
                'name' => $request->name,
                'email'=> $request->email,
                'password' => Hash::make($request->password),
                'role'  => $request->role ?? 'user',
            ]);
            Log::info("✅ User::create() dipanggil", $user->toArray());

            if ($user) {
                Log::info("🎉 User berhasil dibuat dengan ID: " . $user->id);
            } else {
                Log::error("❌ User gagal dibuat (return null/false)");
            }

            return redirect()->route('login')->with('success', 'Registration Successful! Please log in.');

        } catch (\Exception $e) {
            Log::error("❌ Error saat register: " . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }
}
