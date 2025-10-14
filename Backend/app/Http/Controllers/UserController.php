<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Helpers\ActivityLogHelper;

class UserController extends Controller
{
    // Menampilkan semua user (hanya admin yang bisa akses)
    public function index()
    {
        $users = User::all();
        return view('admin.manage', compact('users'));
    }

    public function akun()
    {
        return view('admin.akun');
    }
    
    public function storeuser(Request $request)
{
    // dd("✅ Route masuk ke storeuser()", $request->all());
    Log::info("📌 Masuk ke method storeuser()", ['request' => $request->all()]);

    try {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8', // hapus confirmed kalau ga ada field konfirmasi
        ]);

        Log::info("✅ Validasi sukses");

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role ?? 'user',
        ]);

        Log::info("✅ User::create() dipanggil", ['user' => $user->toArray()]);

        if ($user) {
            Log::info("🎉 User berhasil dibuat dengan ID: " . $user->id);

            // 🔥 Tambahkan log activity
            $details = sprintf(
                "User baru berhasil registrasi dengan email: %s, role: %s",
                $user->email,
                $user->role
            );
            ActivityLogHelper::add('User Registered', $details);    

            return redirect()->back()->with('success', 'User berhasil ditambahkan!');
        } else {
            Log::error("❌ User gagal dibuat (return null/false)");
            return back()->with('error', 'User gagal dibuat.');
        }

    } catch (\Exception $e) {
        Log::error("❌ Error saat register: " . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
        ]);

        // 🔥 Log activity untuk kegagalan
        ActivityLogHelper::add('User Registration Failed', $e->getMessage());

        return back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
    }
}
    public function destroy($id)
        {
            try {
                $user = User::findOrFail($id);
                $email = $user->email;
                $user->delete();

                Log::info("✅ User dihapus: {$email}");

                return response()->json([
                    'success' => true,
                    'message' => "User {$email} berhasil dihapus"
                ]);
            } catch (\Exception $e) {
                Log::error("❌ Error hapus user: " . $e->getMessage());

                return response()->json([
                    'success' => false,
                    'message' => "Gagal menghapus user"
                ], 500);
            }
        }



    // // Dashboard untuk admin
    // public function adminHome()
    // {
    //     return view('admin.home');
    // }

    // // Dashboard untuk customer
    // public function userHome()
    // {
    //     return view('user.uhome');
    // }
}
