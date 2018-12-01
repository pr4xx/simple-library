<?php

use Faker\Generator as Faker;

$factory->define(\App\Book::class, function (Faker $faker) {
    return [
        'signature' => ucfirst($faker->unique()->words(rand(2, 3), true)),
        'title' => ucfirst($faker->unique()->words(rand(3, 8), true)),
        'original_title' => ucfirst($faker->unique()->words(rand(3, 8), true))
    ];
});