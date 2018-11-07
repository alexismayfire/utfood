<?php

use Faker\Generator as Faker;

$factory->define(App\Cardapio::class, function (Faker $faker) {
    return [
        'estabelecimento' => factory(\App\Estabelecimento::class)->create()->id,
        'nome' => $faker->name,
        'pontos' => $faker->numberBetween($min = 1, $max = 10),
        'status' => $faker->boolean($chanceOfGettingTrue = 100)
    ];
});