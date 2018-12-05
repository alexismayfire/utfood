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
        'FavoritoController@estabelecimentosUsuario'
    )->name('favoritos');

    /*
     * Para favoritar um Estabelecimento
     */
    Route::post(
        '/api/conta/favoritar/estabelecimento/{estabelecimento}',
        'FavoritoController@estabelecimento'
    )->name('favoritar_estabelecimento');

    /*
     * Para ver a página de reservas
     * Retorna: array de Reservas do User logado
     */
    Route::get(
        '/api/conta/reservas',
        'ReservaController@reservasUsuario'
    )->name('minhas_reservas');

    /*
     * Para cancelar uma reserva.
     * Exige: Integer (reserva_id) via POST
     * Retorna: View user.reservas
    */
    Route::post(
        '/api/conta/reservas/{reserva}',
        'ReservaController@cancelar'
    )->name('cancelar_minha_reserva');

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

    Route::get(
        '/api/conta/meus-estabelecimentos/editar/{estabelecimento}',
        'EstabelecimentoController@editarEstabelecimento'
    )->name('editar_estabelecimento_view');


    Route::post(
        '/api/conta/meus-estabelecimentos/editar/{estabelecimento}',
        'EstabelecimentoController@editar'
    )->name('editar_estabelecimento_post');
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
 * Para retornar uma busca de elementos por nome
 * Exige: String (querystring)
 * Retorna: array de Estabelecimento
 */
Route::get(
    '/api/estabelecimentos/filtrar',
    'EstabelecimentoController@filtrar'
)->name('filtrar_estabelecimentos');

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

Route::get(
    '/api/conta/meus-estabelecimentos/{estabelecimento}/editar/criar-cardapio',
    'CardapioController@viewCriarEditar'
)->name('criar_cardapio_view');

Route::get(
    '/api/conta/meus-estabelecimentos/{estabelecimento}/editar/{cardapio}',
    'CardapioController@viewCriarEditar'
)->name('editar_cardapio_view');

Route::post(
    '/api/conta/meus-estabelecimentos/{estabelecimento}/editar/cardapios/{cardapio}',
    'CardapioController@criarOuEditar'
)->name('criar_cardapio_post');

Route::delete(
    '/api/conta/meus-estabelecimentos/{estabelecimento}/remover/{cardapio}',
    'CardapioController@removerCardapio'
)->name('remover_cardapio');

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
 * Para buscar reservas em um estabelecimento.
 * Retorna: View estabelecimento.reservas
 */
Route::get(
    '/api/estabelecimentos/{estabelecimento}/{cardapio}/reservas',
    'ReservaController@agenda'
)->name('reservas');

/*
 * Para ver os horários disponíveis de reserva, via solicitação AJAX.
 * Exige: objeto DateTime via POST
 * Retorna: array de DateTime
 */
Route::get(
    '/api/estabelecimentos/{estabelecimento}/{cardapio}/reservas/{dataEscolhida}',
    'ReservaController@horariosDisponiveis'
)->name('reservas_horarios_disponiveis');

/*
 * Para reservar um horário específico.
 * Exige: Integer (hora) via POST
 * Retorna: View estabelecimento.reservas
 */
Route::post(
    '/api/estabelecimentos/{estabelecimento}/{cardapio}/reservas',
    'ReservaController@reservar'
)->name('reservas');

/*
 * Para adicionar um prato à um cardápio
 * Exige: Dados do prato
 * Retorna: View de cadastro de cardápio atualizada com o prato inserido
 */

Route::post(
    '/api/conta/meus-estabelecimentos/{estabelecimento}/editar/{cardapio}/criar',
    'PratoController@criarPrato'
)->name('criar_prato');

Route::delete(
    '/api/conta/meus-estabelecimentos/{estabelecimento}/editar/{cardapio}/{prato}',
    'PratoController@removerPrato'
)->name('remover_prato');

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
