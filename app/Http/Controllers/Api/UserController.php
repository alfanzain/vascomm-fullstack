<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(UserRepository $userRepository, Request $request)
    {
        try {
            $users = $userRepository->get($request);

            return response()->json([
                'code' => 200,
                'message' => 'Get users success',
                'data' => $users
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(UserRepository $userRepository, $id)
    {
        try {
            $user = $userRepository->show($id);

            return response()->json([
                'code' => 200,
                'message' => 'Get user success',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 404,
                'message' => 'User not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function update(UserRepository $userRepository, Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($id),
                ],
                'role' => 'required|exists:roles,id',
                'status' => 'required|in:ACTIVE,INACTIVE',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'code' => 400,
                    'message' => 'User update failed',
                    'data' => $validator->errors(),
                ], 400);
            }

            $user = $userRepository->update($request, $id);

            return response()->json([
                'code' => 200,
                'message' => 'User updated successfully',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(UserRepository $userRepository, $id)
    {
        try {
            $user = $userRepository->destroy($id);

            return response()->json([
                'code' => 200,
                'message' => 'User deleted successfully',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
