<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Domain\Country;
use Faker\Generator as Faker;

$factory->define(Country::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->country,
        'slug' => $faker->unique()->slug(2),
        'parent_id' => null,
        'code' => $faker->countryCode,
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
    ];
});
