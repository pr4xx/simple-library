<?php

use Faker\Generator as Faker;

$factory->define(\App\Tag::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->words(rand(1, 2), true)
    ];
});
