<?php

use App\Domain\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        factory(Country::class, 5)->create()->each(function (Country $country) {
            $country->children()->saveMany(factory(Country::class, random_int(3, 5))->create()->each(function (Country $country) {
                $country->children()->saveMany(factory(Country::class, random_int(3, 5))->make());
            }));
        });
    }
}
