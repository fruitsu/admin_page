<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Career;
use Faker\Generator as Faker;

$factory->define(Career::class, function (Faker $faker) {
    return [
        'title' => $faker->word(2),
        'description' => $faker->text(50)
    ];
});
