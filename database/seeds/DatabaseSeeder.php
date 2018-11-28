<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TipoCozinhaSeeder::class);
        $this->call(TiposConteudoSeeder::class);
        $this->call(EstabelecimentoSeeder::class);
        $this->call(CardapioSeeder::class);
        $this->call(PratoSeeder::class);
        $this->call(AvaliacaoSeeder::class);
    }
}
