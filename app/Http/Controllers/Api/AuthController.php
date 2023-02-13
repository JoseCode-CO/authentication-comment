<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =Hash::make($request->password);

        $user->save();

        return response($user, Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
    }

    public function logout()
    {
    }

    public function allUsers()
    {
    }
}
