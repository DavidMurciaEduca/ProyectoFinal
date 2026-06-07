<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {

            return response()->json([
                'message' => 'Credenciales incorrectas'
            ], 401);
        }

        $user = \App\Models\User::with('zona')->find(Auth::id());

        $token = $user->createToken('angular-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'usuario' => $user
        ]);
    }
}
