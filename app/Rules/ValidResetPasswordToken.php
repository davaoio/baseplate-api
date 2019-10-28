<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\PasswordReset;
use Illuminate\Support\Carbon;

class ValidResetPasswordToken implements Rule
{
    /**
     * PasswordReset email
     *
     * @var string
     */
    private $email;

    /**
     * The message if this validation fail
     *
     * @var string
     */
    private $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) : bool
    {
        $pr = PasswordReset::latest()->whereEmail($this->email)->first();

        if ($pr && $pr->token === $value && $pr->expires_at->greaterThan(Carbon::now())) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() : string
    {
        return trans('passwords.token');
    }
}
