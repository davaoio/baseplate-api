<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use JWTAuth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function __invoke(UserRegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'email' => $request->get('email', null),
                'password' => Hash::make($request->password),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        $token = JWTAuth::fromUser($user);

        return $this->respondWithToken($token, $user->fresh());
    }
}
