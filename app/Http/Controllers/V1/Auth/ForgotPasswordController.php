<?php

namespace App\Http\Controllers\V1\Auth;

use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\PasswordResetResource;
use App\Mail\PasswordReset as PasswordResetMail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
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
     * Create a new password reset instance for reseting password.
     * And send password reset email to user
     *
     * @param \Illuminate\Http\Request
     * @return \App\Http\Resources\PasswordResetResource
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'exists:users'],
        ]);

        $passwordReset = PasswordReset::create([
            'email' => $data['email'],
        ]);

        Mail::to($passwordReset->email)
            ->send(new PasswordResetMail($passwordReset));

        return new PasswordResetResource($passwordReset);
    }
}
