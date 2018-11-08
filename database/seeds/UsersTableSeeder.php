<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nome' => 'Alexandre',
            'email' => 'calexandrelvieira@gmail.com',
            'senha' => bcrypt('teste'),
            'telefone' => '(41) 99857-0244'
        ]);
        factory(\App\User::class, 5);
    }
}
