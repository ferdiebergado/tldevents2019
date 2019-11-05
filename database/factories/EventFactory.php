<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(\App\Event::class, function (Faker $faker) {
    return [
        'title' => $faker->text,
        'started_at' => now()->toDateString(),
        'ended_at' => now()->addDays(4)->toDateString(),
        'type' => $faker->randomElement(['W', 'T', 'C']),
        'grouping' => $faker->randomElement(['R', 'L', 'M', 'N']),
        'deleted_by' => null,
        'deleted_at' => null
    ];
});

$factory->state(\App\Event::class, 'active', [
    'is_active' => true
]);
