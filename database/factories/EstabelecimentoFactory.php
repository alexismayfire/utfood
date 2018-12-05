<?php

use Faker\Generator as Faker;

$factory->define(App\Estabelecimento::class, function (Faker $faker) use ($factory) {
    return [
        'nome' => substr($faker->sentence(2), 0, -1),
        'dono' => factory(\App\User::class)->create()->id,
        'endereco' => $faker->address,
        'telefone' => $faker->phoneNumber,
        'tipo_cozinha_id' => $faker->numberBetween(1, 5)
    ];
});
