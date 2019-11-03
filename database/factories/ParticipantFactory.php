<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Participant::class, function (Faker $faker) {
    return [
        'last_name' => $faker->lastName,
        'first_name' => $faker->firstName,
        'mi' => $faker->randomLetter,
        'sex' => $faker->randomElement(['M', 'F']),
        'station' => $faker->company,
        'mobile' => json_encode($faker->numberBetween(99100000000, 99999999999)),
        'email' => $faker->email
    ];
});
