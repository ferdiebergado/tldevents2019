<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'title' => $faker->text,
        'started_at' => now()->toDateString(),
        'ended_at' => now()->addDays(4)->toDateString(),
    ];
});
