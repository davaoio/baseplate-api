<?php

namespace App\Http\Controllers\V1\Auth;

use DB;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Actions\SendVerificationCode;
use App\Http\Requests\RegisterUserRequest;

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

    /**
     * Create a new user instance after a valid registration.
     *
     * @param RegisterUserRequest $request
     * @param SendVerificationCode $sendVerificationCode
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function __invoke(RegisterUserRequest $request, SendVerificationCode $sendVerificationCode)
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

        $sendVerificationCode->execute($user);

        $user = $user->refresh();

        return $this->respondWithToken(auth()->login($user), new UserResource($user));
    }
}
