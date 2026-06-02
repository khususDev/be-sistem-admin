<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administrator\User; // Sesuaikan path model User Anda jika berbeda
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Cari User berdasarkan Email
        $user = User::where('email', $request->email)->first();

        // 3. Cek apakah User ada dan Password cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password salah!'
            ], 401); // 401 = Unauthorized
        }

        // 4. Kumpulkan Kunci (Permissions & Roles)
        // Kita gunakan relasi role() yang ada di Model User, bukan bawaan Spatie
        $roles = [];
        $permissions = [];

        // Cek apakah user ini memiliki role_id yang terisi
        if ($user->role) {
            $roles[] = $user->role->name; // Masukkan nama role ke dalam array

            // Ambil daftar permissions yang nyantol di role tersebut
            $permissions = $user->role->permissions->pluck('name');
        }

        // 5. Cetak Tiket Masuk (Token)
        $token = $user->createToken('erp-token')->plainTextToken;

        // 6. Kembalikan Respons ke Vue
        return response()->json([
            'success' => true,
            'message' => 'Login berhasil!',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'roles' => $roles,
                    'permissions' => $permissions
                ],
                'token' => $token
            ]
        ]);
    }

    public function logout(Request $request)
    {
        // Hapus token yang sedang digunakan saat ini
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil!'
        ]);
    }
}
