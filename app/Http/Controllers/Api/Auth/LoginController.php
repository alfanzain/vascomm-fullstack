<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Repositories\UserRepository;

class LoginController extends Controller
{
    public function login(UserRepository $userRepository, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Login failed',
                'data' => $validator->errors(),
            ], 400);
        }

        $user = $userRepository->checkEmail($request->email);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'code' => 403,
                'message' => 'Login failed',
                'data' => null,
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Login successfully',
            'data' => [
                'token' => $user->createToken('authToken')->accessToken
            ],
        ]);
    }
    public function logout(Request $request)
    {
        $removeToken = $request->user()->tokens()->delete();

        if ($removeToken) {
            return response()->json([
                'code' => 200,
                'message' => 'Logout successfully',
                'data' => null,
            ]);
        }
    }
}
