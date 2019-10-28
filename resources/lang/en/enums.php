<?php

use App\Enums\ErrorCodes;

return [

    ErrorCodes::class => [
        ErrorCodes::UNVERIFIED_EMAIL => 'Email is not verified.',
        ErrorCodes::UNVERIFIED_PHONE_NUMBER => 'Phone number is not verified.',
        ErrorCodes::UNVERIFIED_ACCOUNT => 'User account is not verified.',
        ErrorCodes::INVALID_CREDENTIALS => 'We couldn\'t find any records that matches your credentials.',
        ErrorCodes::INVALID_USERNAME => 'We couldn\'t find any records that matches your username.',
        ErrorCodes::INVALID_PASSWORD => 'Your password did not match on our records.',
    ],
];
