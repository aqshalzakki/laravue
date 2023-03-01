<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'success'   => false,
                'message' => 'Email atau password anda salah.'
            ], 404);
        }

        $token = $user->createToken('ApiToken')->plainTextToken;

        $response = [
            'success'   => true,
            'user'      => $user,
            'token'     => $token
        ];

        return response($response, 201);
    }

    /**
     * logout
     *
     * @return void
     */
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'success'    => true
        ], 200);
    }
}
