<?php

use App\Estabelecimento;
use App\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EstabelecimentoController;
use App\Http\Controllers\CardapioController;
use App\Http\Controllers\PratoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\AvaliacaoController;
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

Auth::routes();

// As rotas do boilerplate de Auth do Laravel só aceita POST para logout...
//Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function() {
    return view('home');
});

/* Rotas de admin */
// Para gerenciar os usuários. Ex.: dar permissões?
Route::get(
    '/api/usuarios',
    'UserController@exibirTodos'
)->name('usuarios');

Route::group(['middleware' => ['auth']], function () {
    /* Rotas de usuários */

    /*
     * Para visualizar o próprio perfil
     * Retorna: objeto do User logado
     */
    Route::get(
        '/api/conta',
        'UserController@conta'
    )->name('conta');

    /*
     * Para atualizar o próprio perfil
     * Retorna: objeto do User logado
     */
    Route::post(
        '/api/conta',
        'UserController@editarConta'
    )->name('editar_conta');

    /*
     * Para ver a página de favoritos
     * Retorna: array de Favoritos do User logado
     */
    Route::get(
        '/api/conta/favoritos',
        'UserController@favoritos'
    )->name('favoritos');

    /*
     * Para ver a página de reservas
     * Retorna: array de Reservas do User logado
     */
    Route::get(
        '/api/conta/reservas',
        'UserController@reservas'
    )->name('minhas_reservas');

    /*
     * Para gerenciar os estabelecimentos do usuário. O menu principal precisa ser alterado
     * Retorna: lista de Estabelecimentos que o User logado possui
     */
    Route::get(
        '/api/conta/meus-estabelecimentos',
        'UserController@gerenciarEstabelecimentos'
    )->name('meus_estabelecimentos');

    Route::get(
        '/api/conta/meus-estabelecimentos/criar',
        function () { return view('estabelecimento.criar', ['usuario' => Auth::user()]); }
    )->name('criar_estabelecimento');

    Route::post(
        '/api/conta/meus-estabelecimentos/criar',
        'EstabelecimentoController@criar'
    )->name('criar_estabelecimento');

    /*
     * Para ver outros perfis, como de amigos
     * Retorna: objeto de User
     */
    Route::get(
        '/api/usuarios/{usuario}',
        'UserController@exibir'
    )->name('usuario');
});

/*
 * Para ver a lista dos estabelecimentos
 * Retorna: array de Estabelecimento
 */
Route::get(
    '/api/estabelecimentos',
    'EstabelecimentoController@exibirTodos'
)->name('estabelecimentos');

/*
 * Para visitar a página de um estabelecimento específico.
 * Aqui, deveria decidir se outras informações serão retornadas (como avaliações).
 * Retorna: objeto de Estabelecimento
 */
Route::get(
    '/api/estabelecimentos/{estabelecimento}',
    'EstabelecimentoController@exibir'
)->name('estabelecimento');

/*
 * Para ver os cardápios disponíveis de um estabelecimento.
 * Precisa pensar na questão de disponibilidade por dia aqui. Exibe todos ou filtra pela disponibilidade?
 * De qualquer forma, o estabelecimento pode ter N cardápios válidos para um dia.
 * Retorna: array de Cardapio
 */
Route::get(
    '/api/estabelecimentos/{estabelecimento}/cardapios',
    'CardapioController@exibirTodos'
)->name('cardapios');

/*
 * Para ver um cardápio específico de um estabelecimento.
 * Nessa rota, será exibida a opção de reservar o cardápio escolhido.
 * Retorna: objeto de Cardapio
 */
Route::get(
    '/api/estabelecimentos/{estabelecimento}/cardapios/{cardapio}',
    'CardapioController@exibir'
)->name('cardapio');

/*
 * Para ver as avaliações de um cardápio.
 * Aqui não sei se é um controller separado. Mesmo caso de exibir as avaliações do estabelecimento!
 * Retorna: array de Avaliacoes relacionadas ao TipoConteudo de Cardapio (o controller deve tratar isso)
 */
Route::get(
    '/api/estabelecimentos/{estabelecimento}/cardapios/{cardapio}/avaliacoes',
    'AvaliacaoController@exibirCardapio'
)->name('avaliacoes_cardapio');

/*
 * Para ver as avaliações de um estabelecimento.
 * Retorna: array de Avaliacoes relacionadas ao TipoConteudo de Estabelecimento (o controller deve tratar isso)
 */
Route::get(
    '/api/estabelecimentos/{estabelecimento}/avaliacoes',
    'AvaliacaoController@exibirEstabelecimento'
)->name('avaliacoes_estabelecimento');

/*
 * Para enviar uma avaliação ao estabelecimento. Deve usar o User logado para registrar.
 * Exige: Integer entre 1 e 5
 * Opcional: String para o comentário
 * Retorna: objeto de Avaliacao que foi criado (para atualizar o state?)
 */
Route::post(
    '/api/estabelecimentos/{estabelecimento}/avaliacoes',
    'AvaliacaoController@avaliar'
)->name('avaliar');

/*
 * Para ver os horários disponíveis de reserva.
 * Retorna: array de DateTime
 */
Route::get(
    '/api/estabelecimentos/{estabelecimento}/{cardapio}/reservas',
    'ReservaController@agenda'
)->name('reservas');

/*
 * Para reservar um horário específico.
 * Exige: objeto DateTime via POST
 * Retorna: objeto Reserva criado (para atualizar o state?)
 */
Route::post(
    '/api/estabelecimentos/{estabelecimento}/{cardapio}/reservas',
    'ReservaController@reservar'
)->name('reservar');

/*
 * Aqui são as rotas usando Collections (da pasta App/Http/Resources).
 * Pela documentação, talvez seja a maneira correta de trabalhar com Ajax/frameworks JS.
 * Porém, as chamadas realizadas podem ser feitos pelos Controllers vinculados acima.
 * Fica aqui registrado o teste, pelo menos, porque pode ser útil depois!
 */

/*
Route::get('/usuarios/{id}', function($id) {
    return User::findOrFail($id);
});

Route::get('/estabelecimentos', function() {
    return new EstabelecimentoCollection(Estabelecimento::all());
})->name('estabelecimentos');

Route::get('estabelecimentos/{id}', function($id) {
    return Estabelecimento::findOrFail($id);
})->name('estabelecimento');
*/
