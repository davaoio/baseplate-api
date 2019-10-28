<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\Models\PasswordReset;

$factory->define(PasswordReset::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
    ];
});
