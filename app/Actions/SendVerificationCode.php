<?php

namespace App\Actions;

use App\Models\User;
use App\Notifications\VerifyEmail;
use App\Notifications\VerifyPhoneNumber;

class SendVerificationCode
{

    /**
     * The user to be verified
     *
     * @var User
     */
    public $user;

    /**
     * Execute this action
     *
     * @param string $via [email, phone_number]
     * @return void
     */
    public function execute(User $user)
    {
        $this->user = $user;

        return $this->sendCodeViaEmail();
    }

    /**
     * Send verification code to user via email
     *
     * @return void
     */
    private function sendCodeViaEmail()
    {
        if (!$this->user->isEmailVerified()) {
            $this->user->notify(new VerifyEmail());
        }
    }
}
