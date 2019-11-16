<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class ErrorCodes extends Enum implements LocalizedEnum
{
    /**
     * Error code for unverified email
     */
    const UNVERIFIED_EMAIL = 'UNVERIFIED_EMAIL';


    /**
     * Error code for unverified phone number
     */
    const UNVERIFIED_PHONE_NUMBER = 'UNVERIFIED_PHONE_NUMBER';

    /**
     * Error code for unverified account
     */
    const UNVERIFIED_ACCOUNT = 'UNVERIFIED_ACCOUNT';

    /**
     * Error code for invalid account Credentioals
     */
    const INVALID_CREDENTIALS = 'INVALID_CREDENTIALS';

    /**
     * Error code for invalid username
     */
    const INVALID_USERNAME = 'INVALID_USERNAME';

    /**
     * Error code for invalid password
     */
    const INVALID_PASSWORD = 'INVALID_PASSWORD';
}
