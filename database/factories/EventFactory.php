<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'started_at' => $faker->date(),
        'ended_at' => $faker->date(),
    ];
});
