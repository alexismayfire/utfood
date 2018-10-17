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
            'name' => 'Alexandre',
            'email' => 'calexandrelvieira@gmail.com',
            'password' => bcrypt('teste'),
        ]);
        factory(\App\User::class, 5);
    }
}
