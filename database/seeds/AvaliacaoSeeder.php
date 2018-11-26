<?php

use Illuminate\Database\Seeder;

class AvaliacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('avaliacoes')->insert([
            'usuario' => 1,
            'estrelas' => 3,
            'tipos_conteudo' => 1,
            'tipo_conteudo_id' => 1,
            'comentario' => 'Ruim demais'
        ]);
    }
}
