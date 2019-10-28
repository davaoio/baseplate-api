<?php

namespace App\Rules;

use Twilio\Exceptions\RestException;
use Illuminate\Contracts\Validation\Rule;

class ValidPhoneNumber implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) : bool
    {
        try {
            $res = app('TwilioClient')->lookups->v1->phoneNumbers($value)->fetch();
        } catch (RestException $e) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.valid_phone_number');
    }
}
