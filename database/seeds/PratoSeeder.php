<?php

use Illuminate\Database\Seeder;
use \App\Prato;

class PratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 30; $i++)
        {
            for($j = 1; $j <= 3; $j++)
            {
                $tipoCozinha = rand(1, 3);
                factory(Prato::class, 1)->create([
                    'cardapio' => $i,
                    'tipo' => $j,
                    'tipo_cozinha' => $tipoCozinha
                ]);
            }
        }
    }
}
