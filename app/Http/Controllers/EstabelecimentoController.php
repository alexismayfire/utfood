<?php

namespace App\Http\Controllers;

use App\Cardapio;
use Illuminate\Http\Request;
use App\Estabelecimento;
use App\Avaliacao;

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

    /*
     * Com essa função, é possível acessar o estabelecimento através de uma slug, ao invés do ID na url
    public function getRouteKeyName() {
        return 'slug'
    }
    */
}
