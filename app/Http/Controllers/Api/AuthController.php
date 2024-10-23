<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function loginApi(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Temukan user berdasarkan username
        $user = User::where('username', $credentials['username'])->first();

        // Periksa apakah user ditemukan dan password benar
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
                'data' => []
            ], 401);
        }

        // Hapus token lama (opsional)
        $user->tokens()->delete();

        // Generate token baru
        $token = $user->createToken('authToken')->plainTextToken;

        // Berikan respons dalam format JSON

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'user' => $user,
                'token' => $token,
            ],
        ]);
    }

    public function logoutApi(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Logout successful',
            'data' => []
        ]);
    }
}
