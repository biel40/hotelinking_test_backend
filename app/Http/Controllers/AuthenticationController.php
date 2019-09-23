<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{

    //TODO: Prueba este endpoint
    public function registrateUser(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        $user = new User([
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->save();

        return response()->json(['message' => 'Usuario creado correctamente'], 201);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean',
        ]);

        if (!Auth::attempt($loginData)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $accessToken = auth()->user()->createToken('authToken')->access_token;

        $accessToken->save();

        return response()->json([
            'user' => auth()->user(),
            'token_type' => 'Bearer',
            'access_token' => $generatedToken->accessToken,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' =>
            'Successfully logged out']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

}