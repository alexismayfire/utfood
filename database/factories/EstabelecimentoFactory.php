<?php

use Faker\Generator as Faker;

$factory->define(App\Estabelecimento::class, function (Faker $faker) use ($factory) {
    return [
        'name' => substr($faker->sentence(2), 0, -1),
        'slug' => $faker->url,
        'owner' => factory(\App\User::class)->create()->id
    ];
});
