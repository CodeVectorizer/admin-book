<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return \response()->json([
                'success' => false,
                'message' => 'The provided credentials are incorrect.',
                'data' => null
            ], 401);
        }

        return \response()->json([
            'success' => true,
            'message' => 'Login successfully',
            'data' => $user,
            'token' => $user->createToken('access_token')->plainTextToken,
        ], 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        $user->currentAccessToken()->delete();

        return \response()->json([
            'success' => true,
            'message' => 'Logout successfully',
            'data' => null
        ], 200);
    }
}
