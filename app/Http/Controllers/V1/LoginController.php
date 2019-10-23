<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function __invoke(UserLoginRequest $request)
    {
        if (!auth()->attempt($request->only(['email', 'password']))) {
            return response(['message' => 'Invalid credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response()
            ->json(['user' => auth()->user(), 'access_token' => $accessToken])
            ->setStatusCode(200);
    }
}
