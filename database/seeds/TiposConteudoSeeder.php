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
        DB::table('tipos_conteudo')->insert([
            'id' => 1,
            'tipo' => 1,
        ]);
    }
}
