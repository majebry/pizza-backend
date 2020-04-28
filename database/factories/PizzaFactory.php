<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pizza;
use Faker\Generator as Faker;

$factory->define(Pizza::class, function (Faker $faker) {
    $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

    return [
        'name'          => $faker->vegetableName() . ' Pizza',
        'price_in_euro' => $faker->randomFloat(2, 10, 20),
        'image_path'    => 'pizza.jpg'
    ];
});
