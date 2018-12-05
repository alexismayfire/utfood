<?php

use Faker\Generator as Faker;

$factory->define(App\Prato::class, function (Faker $faker) {
    return [
        'titulo' => $faker->name,
        'descricao' => substr($faker->sentence(20), 0, -1),
        //'tipo_cozinha' => $faker->numberBetween(1, 5),
        //'cardapio' => $faker->numberBetween(1, 30),
        'preco' => $faker->randomFloat(2, 10, 500),
    ];
});
