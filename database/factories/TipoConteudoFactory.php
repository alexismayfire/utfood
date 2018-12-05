<?php

use Faker\Generator as Faker;

$factory->define(\App\TipoConteudo::class, function (Faker $faker) use ($factory) {
    return [
        'avaliacao_id' => factory(\App\Avaliacao::class)->create()->id,
        'tipo_conteudo_type' => '\App\Avaliacao'
    ];
});
