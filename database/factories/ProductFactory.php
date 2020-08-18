<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(6),
        'details' => $faker->text(300),
        'price_starts' => $faker->randomFloat(2,1,5),
        'price_ends' => $faker->randomFloat(2,5,10),
    ];
});
