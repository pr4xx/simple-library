<?php

use Faker\Generator as Faker;

$factory->define(\App\Book::class, function (Faker $faker) {
    return [
        'title' => ucfirst($faker->unique()->words(rand(3, 8), true)),
        'original_title' => ucfirst($faker->unique()->words(rand(3, 8), true))
    ];
});

$factory->afterCreating(\App\Book::class, function ($book, $faker) {
    $instance = new \App\Instance();
    $instance->signature = str_limit(md5($book->title), 7, '');
    $book->instances()->save($instance);
});