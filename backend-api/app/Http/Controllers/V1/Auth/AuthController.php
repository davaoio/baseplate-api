<?php

namespace App\Http\Controllers\V1\Auth;

use App\Models\User;
use App\Enums\ErrorCodes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['login', 'checkUsername']]);
        $this->middleware('throttle:10,1', ['except' => ['me']]);
    }

    /**
     * Check if email exist
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkEmail(Request $request)
    {
        $data = $request->validate(['email' => 'required']);

        $user = User::where('email', $data['email'])
            ->first();

        if ($user) {
            return response()->json([
                'data' => ['email' => $data['email']]
            ]);
        }

        return $this->respondWithError(ErrorCodes::INVALID_USERNAME, 404);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $data['email'])
            ->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            $token = auth()->login($user);
            return $this->respondWithToken($token, new UserResource($user));
        }

        return $this->respondWithError(ErrorCodes::INVALID_PASSWORD, 401);
    }

    /**
     * Get the authenticated User.
     *
     * @return \App\Http\Resources\UserResource
     */
    public function me()
    {
        return new UserResource(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
}
