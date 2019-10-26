<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Program::class, function (Faker $faker) {
    return [
        'title' => $faker->text,
        'key_stage' => $faker->numberBetween(1, 4),
    ];
});
