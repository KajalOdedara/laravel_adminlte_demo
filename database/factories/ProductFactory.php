<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'sku' => $faker->unique()->randomNumber,
        'description' => \Str::random(20),
        'price' => $faker->numberBetween(1000, 10000),
        'quantity' => $faker->numberBetween(1, 100),
        'sales' => $faker->numberBetween(1, 100)
    ];
});
