<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Hashing\BcryptHasher;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hasher = new BcryptHasher();

        DB::table('users')->insert([
            'name' => 'Alexandre',
            'email' => 'calexandrelvieira@gmail.com',
            'password' => $hasher->make('alexandre'),
            'remember_token' => str_random(10),
            'telefone' => '(41) 99857-0244'
        ]);
        DB::table('users')->insert([
            'name' => 'Tiago',
            'email' => 'tiagocolli@gmail.com',
            'password' => $hasher->make('tiago'),
            'remember_token' => str_random(10),
            'telefone' => '(41) 9999-9999'
        ]);
        factory(\App\User::class, 5);
    }
}
