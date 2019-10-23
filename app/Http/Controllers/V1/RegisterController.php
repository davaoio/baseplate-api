<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
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

        $accessToken = $user->createToken('authToken')->accessToken;

        return response()
            ->json(['user' => $user->fresh(), 'access_token' => $accessToken])
            ->setStatusCode(201);
    }
}
