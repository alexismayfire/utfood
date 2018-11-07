<?php

use Illuminate\Database\Seeder;

class CardapioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Cardapio::class, 5)->create();
    }
}
