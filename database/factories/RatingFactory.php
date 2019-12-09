<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Rating::class, function (Faker $faker) {
    $date = now();
    $date->addMonths(rand(-20,5));
    return [
        'post_id' => rand(1,200),
        'user_id' => rand(1,50),
        'rating' => rand(0,5),
        'created_at' => $date,
        'updated_at' => $date
    ];
});
