<?php

use Illuminate\Database\Seeder;

class TiposConteudoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * 1 => Estabelecimento
         * 2 => Cardapio
         * 3 => Prato
         */

        DB::table('tipos_conteudo')->insert(['tipo' => 1]);
        DB::table('tipos_conteudo')->insert(['tipo' => 2]);
        DB::table('tipos_conteudo')->insert(['tipo' => 3]);
    }
}
