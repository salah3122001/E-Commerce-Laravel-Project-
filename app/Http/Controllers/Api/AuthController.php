<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'User Registered Successfully',
            'token' => $token,
            'user' => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $user = User::where('email', $data['email'])->first();

        if (!$user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid Credentials'],
            ]);
        }

        $token = $user->createToken('api_token')->plainTextToken;
        return response()->json([
            'status' => 'success',
            'message' => 'Logged In Successfuly',
            'token' => $token,
            'user' => $user,
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully',
        ]);
    }

   public function logoutall(Request $request)
{
    $user = $request->user();

    $user->tokens()->delete();

    return response()->json([
        'status' => 'success',
        'message' => 'Logged out from all devices successfully.',
    ], 200);
}

}
