<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Requests\UsuarioRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
{
    $credentials = ['email' => $request->email, 'password' => $request->password];

    if (!$token = Auth::guard('api')->attempt($credentials)) {
        return response()->json(['message' => 'Credenciales incorrectas.'], 401);
    }

    return $this->respondWithToken($token);
}

    


    // Método para cerrar sesión
    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Sesión cerrada correctamente.']);
    }

    public function perfil()
    {
        return response()->json(Auth::user());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'usuario' => Auth::user()
        ]);
    }
}
