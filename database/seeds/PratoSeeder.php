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
        factory(Prato::class, 60)->create();
    }
}
