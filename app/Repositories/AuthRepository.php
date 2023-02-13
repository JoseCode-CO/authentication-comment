<?php

namespace App\Repositories;

use App\Http\Resources\V1\AuthResource;
use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{

    /**
     * It takes a request, validates it, creates a user, and returns a resource
     *
     * @param request The request object.
     *
     * @return A new AuthResource object.
     */
    public function register($request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password)
        ]);

        return new AuthResource($user);
    }

    /**
     * A function that allows you to log in to the application.
     *
     * @param request The request object.
     *
     * @return A token and a cookie
     */
    public function login($request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            return $token;
        } else {
            return response(["message" => "Credenciales invalidas"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * It deletes the current access token of the user
     *
     * @param request The incoming request object.
     *
     * @return The current access token is being deleted.
     */
    public function logout($request)
    {
        return   $request->user()->currentAccessToken()->delete();
    }
}
