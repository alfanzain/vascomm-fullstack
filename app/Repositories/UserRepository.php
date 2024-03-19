<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserRepository
{
    public function get(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $take = $request->input('take', 10);
        $skip = $request->input('skip', 0);

        return $query->take($take)->skip($skip)->get();
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 'ACTIVE',
        ]);

        return $user;
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->status = $request->input('status');
        $user->save();

        return $user;
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }

    public function checkEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
