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
    Log::info("📩 Masuk ke method storeuser()", ['request' => $request->all()]);

    try {
        // 🔍 Validasi input
        $validated = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|string|email|max:100|unique:users,email',
            'password' => 'required|string|min:8',
            'role'     => 'nullable|in:user,approver,admin', // validasi role agar aman
        ]);

        Log::info("✅ Validasi sukses", ['validated' => $validated]);

        // 🧱 Buat user baru
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'] ?? 'user',
        ]);

        Log::info("✅ User berhasil dibuat", ['user' => $user->toArray()]);

        // 🧾 Tambahkan log aktivitas
        $details = sprintf(
            "User baru dibuat: %s (Role: %s)",
            $user->email,
            $user->role
        );
        ActivityLogHelper::add('User Registered', $details);

        return redirect()->back()->with('success', 'User berhasil ditambahkan!');

    } catch (\Illuminate\Validation\ValidationException $e) {
        // 🔥 Error validasi
        Log::warning("⚠️ Validasi gagal", ['errors' => $e->errors()]);
        return back()
            ->withErrors($e->errors())
            ->withInput();

    } catch (\Exception $e) {
        // ❌ Error lain (misal DB, logic, dll)
        Log::error("💥 Error saat register: " . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
        ]);

        ActivityLogHelper::add('User Registration Failed', $e->getMessage());

        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
