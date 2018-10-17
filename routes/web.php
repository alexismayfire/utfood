<?php

use App\Estabelecimento;
use App\User;
use App\Http\Resources\EstabelecimentoCollection;
use App\Http\Resources\UserCollection;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users/{id}', function($id) {
    return User::findOrFail($id);
});

Route::get('/users', function() {
    return new UserCollection(User::all());
});

Route::get('estabelecimentos/{id}', function($id) {
    return Estabelecimento::findOrFail($id);
});

Route::get('/estabelecimentos', function() {
    return new EstabelecimentoCollection(Estabelecimento::all());
});
