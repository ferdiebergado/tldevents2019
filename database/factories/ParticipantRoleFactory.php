<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\ParticipantRole::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'sequence' => $faker->numberBetween(1, 5),
    ];
});
