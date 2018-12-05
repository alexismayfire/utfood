<?php

use Faker\Generator as Faker;

$factory->define(\App\Avaliacao::class, function (Faker $faker) {
    return [
        'usuario' => $faker->numberBetween($min = 1, $max = 10),
        'estrelas' => $faker->numberBetween($min = 1, $max = 5),
        'tipos_conteudo' => 1,
        'tipo_conteudo_id' => $faker->numberBetween($min = 1, $max = 10),
//        'avaliado_id' => $faker->numberBetween($min = 1, $max = 10),
//        'avaliado_type' => '\App\Estabelecimento',
        'comentario' => substr($faker->sentence(10), 0, -1)
    ];
});
