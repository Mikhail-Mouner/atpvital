<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $request['password'] = Hash::make($request->password);
        $request['remember_token'] = Str::random(10);

        $user = User::create($request->toArray());

        //generate the token for the user
        $token = $user->createToken('Client')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    public function login(LoginRequest $request)
    {
        $login_credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (auth()->attempt($login_credentials)) {
            //generate the token for the user
            $token = auth()->user()->createToken('Client')->accessToken;

            //now return this token on success login attempt
            return response()->json(['token' => $token], 200);
        }

        //wrong login credentials, return, user not authorised to our system, return error code 401
        return response()->json(['error' => 'UnAuthorised Access'], 401);
    }

    public function me()
    {
        return response()->json(['user' => auth()->user()], 200);
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();

        return response()->json(['message' => 'You have been successfully logged out!'], 200);
    }
}
