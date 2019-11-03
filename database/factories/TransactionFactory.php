<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {
    return [
        'participant_id' => function () {
            return factory(App\Participant::class)->create()->id;
        },
        'event_id' => function () {
            return factory(App\Event::class)->create()->id;
        },
        'participant_role_id' => function () {
            return factory(App\ParticipantRole::class)->create()->id;
        },
        'learning_area_id' => function () {
            return factory(App\LearningArea::class)->create()->id;
        },
        'language_id' => function () {
            return factory(App\Language::class)->create()->id;
        },
    ];
});
