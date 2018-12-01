<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Avaliacao;
use App\Cardapio;
use App\Estabelecimento;
use App\UserEstabelecimento;

class EstabelecimentoController extends Controller
{
    private $tipoConteudo = 1;

    public function exibirTodos()
    {
        return view('estabelecimento.list', ['estabelecimentos' => Estabelecimento::all()]);
    }

    public function exibir(Estabelecimento $estabelecimento)
    {
        $avaliacoes = Avaliacao::where([
            ['tipos_conteudo', 1], ['tipo_conteudo_id', $estabelecimento->id]
        ])->get();

        $cardapios = Cardapio::where('estabelecimento', $estabelecimento->id)->get();

        return view(
            'estabelecimento.profile',
            ['estabelecimento' => $estabelecimento, 'avaliacoes' => $avaliacoes, 'cardapios' => $cardapios]
        );
    }

    public function criar(Request $request)
    {
        $user = Auth::user();
        $estabelecimento = new Estabelecimento;

        $estabelecimento->nome = $request->input('nome');
        $estabelecimento->endereco = $request->input('endereco');
        $estabelecimento->telefone = $request->input('telefone');
        $estabelecimento->dono = Auth::user()->id;
        $estabelecimento->save();

        $userEstabelecimento = new UserEstabelecimento;
        $userEstabelecimento->user = $user->id;
        $userEstabelecimento->estabelecimento = $estabelecimento->id;
        $userEstabelecimento->save();

        return $this->exibir($estabelecimento);
    }

    /*
     * Com essa função, é possível acessar o estabelecimento através de uma slug, ao invés do ID na url
    public function getRouteKeyName() {
        return 'slug'
    }
    */
}
