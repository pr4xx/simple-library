<?php

use Faker\Generator as Faker;

$factory->define(\App\Reader::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'street' => $faker->streetName . ' ' . rand(1, 50),
        'zip' => rand(10000, 99999),
        'city' => $faker->city,
        'mobile' => $faker->phoneNumber,
        'email' => $faker->email,
        'has_whatsapp' => (bool) rand(0, 1),
        'paid_deposit' => (bool) rand(0, 1),
        'notes' => rand(0, 1) ? ucfirst($faker->words(rand(0, 100), true)) : null
    ];
});