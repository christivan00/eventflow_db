<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserCustom; // Pastikan pakai Model UserCustom yang kita buat
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // 1. REGISTER (Daftar Akun Baru)
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_user' => 'required',
            'email_user' => 'required|email|unique:tb_user,email_user',
            'pass_user' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()], 400);
        }

        // Simpan User
        $user = UserCustom::create([
            'name_user' => $request->name_user,
            'email_user' => $request->email_user,
            // Password kita hash (acak) biar aman
            'pass_user' => Hash::make($request->pass_user) 
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Register Berhasil',
            'data' => $user
        ], 201);
    }

    // 2. LOGIN (Masuk Aplikasi)
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_user' => 'required|email',
            'pass_user' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()], 400);
        }

        // Cari user berdasarkan email
        $user = UserCustom::where('email_user', $request->email_user)->first();

        // Cek apakah user ada DAN passwordnya cocok
        if (!$user || !Hash::check($request->pass_user, $user->pass_user)) {
            return response()->json([
                'status' => false,
                'message' => 'Email atau Password salah'
            ], 401);
        }

        return response()->json([
            'status' => true,
            'message' => 'Login Berhasil',
            'data' => $user // Android akan menyimpan ID ini untuk request selanjutnya
        ]);
    }
}