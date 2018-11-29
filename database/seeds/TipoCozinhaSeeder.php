<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Hashing\BcryptHasher;

class TipoCozinhaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_cozinha')->insert([
            'titulo' => 'Japonesa'
        ]);

        DB::table('tipo_cozinha')->insert([
            'titulo' => 'Italiana'
        ]);

        DB::table('tipo_cozinha')->insert([
            'titulo' => 'Sanduíches'
        ]);

        DB::table('tipo_cozinha')->insert([
            'titulo' => 'Pizza'
        ]);

        DB::table('tipo_cozinha')->insert([
            'titulo' => 'Brasileira'
        ]);
    }
}
