<?php

use Illuminate\Database\Seeder;

class EstabelecimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Estabelecimento::class, 5)->create();
    }
}
