<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $authRepository;

    function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * It creates a new user.
     *
     * @param Request request The request object.
     */
    public function register(Request $request)
    {
        try {
            $user = $this->authRepository->register($request);
            return  response($user, Response::HTTP_CREATED);
        } catch (\Exception $ex) {
            return  response([
                "message" => "Algo salio mal al registrar el usuario", "error" => $ex->getMessage(), "line" => $ex->getCode()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * A function that allows you to authenticate a user.
     *
     * @param Request request The request object.
     *
     * @return The token is being returned.
     * @bodyParam email string required Email of the user. Example: jose123@gmail.com
     * @bodyParam password password required password of the user. Example: root
     */
    public function authenticate(Request $request)
    {
        try {
            $sesion = $this->authRepository->login($request);
            return response(["token" => $sesion], Response::HTTP_OK);

        } catch (\Exception $ex) {
            return  response(["message" => "Algo salio mal al registrar el usuario"] . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    public function userProfile()
    {
        return response()->json([
            "message" => "userProfile Ok",
            "userData" => auth()->user()
        ], Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        //$cookie = Cookie::forget('cookie_token');

        try {
            $user = $this->authRepository->logout($request);
            return  response(["message" => "Cierre de sesión"], Response::HTTP_OK);
        } catch (\Exception $ex) {
            return  response(["message" => "Algo salio mal al registrar el usuario"]  . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }
}
