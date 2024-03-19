<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\UserRepository;

class RegisterController extends Controller
{
    public function register(UserRepository $userRepository, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|exists:roles,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'User register failed',
                'data' => $validator->errors(),
            ], 400);
        }

        $user = $userRepository->store($request);

        return response()->json([
            'code' => 200,
            'message' => 'User registered successfully',
            'data' => $user
        ]);
    }
}
