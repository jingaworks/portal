<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Profile;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'phone' => $faker->phoneNumber
    ];
});
