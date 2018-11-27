<?php

use Faker\Generator as Faker;

$factory->define(\App\Category::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->words(rand(1, 3), true)
    ];
});
