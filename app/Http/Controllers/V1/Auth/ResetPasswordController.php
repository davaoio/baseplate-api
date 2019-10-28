<?php

namespace App\Http\Controllers\V1\Auth;

use App\Models\User;
use App\Models\PasswordReset;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
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
        $this->middleware('throttle:6,1');
    }

    /**
     * Update user password and remove all password_reset associated to user
     *
     * @param ResetPasswordRequest $request
     * @return void
     */
    public function __invoke(ResetPasswordRequest $request)
    {
        \DB::transaction(function () use ($request) {
            // Change user password
            $user = User::where('email', $request->email)->first();
            $user->password = Hash::make($request->password);
            $user->save();

            // Remove all password reset entry for this email
            PasswordReset::whereEmail($user->email)->delete();
        });

        return response()->json([
            'message' => trans('passwords.reset'),
        ]);
    }
}
