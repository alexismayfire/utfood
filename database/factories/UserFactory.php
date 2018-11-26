<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Hashing\BcryptHasher;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    $hasher = new BcryptHasher();
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $hasher->make('teste'), // '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm' secret
        'remember_token' => str_random(10),
        'telefone' => $faker->phoneNumber
    ];
});
