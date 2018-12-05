<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Avaliacao;
use App\Cardapio;
use App\Estabelecimento;
use App\UserEstabelecimento;
use App\Prato;

class EstabelecimentoController extends Controller
{
    private $tipoConteudo = 1;

    public function exibirTodos()
    {
        $estabelecimentos = Estabelecimento::all();
        $avaliacoes[] = [];
        foreach ($estabelecimentos as $estabelecimento)
        {
            $avaliacoes[$estabelecimento->id] = Avaliacao::where([
                ['tipos_conteudo', 1], ['tipo_conteudo_id', $estabelecimento->id]
            ])->count();
        }

        return view('estabelecimento.list', ['estabelecimentos' => $estabelecimentos, 'avaliacoesCount' => $avaliacoes]);
    }

    public function filtrar(Request $request)
    {
        if ($request->query->get('nome'))
        {
            $estabelecimentos = Estabelecimento::where('nome', 'ilike', '%' . $request->input('nome') . '%')->get();
            return response()->json(['estabelecimentos' => $estabelecimentos]);
        }
    }

    public function exibir(Estabelecimento $estabelecimento)
    {
        $avaliacoes = Avaliacao::where([
            ['tipos_conteudo', 1], ['tipo_conteudo_id', $estabelecimento->id]
        ])->get();

        return view(
            'estabelecimento.profile',
            ['estabelecimento' => $estabelecimento, 'avaliacoes' => $avaliacoes]
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

    public function editarEstabelecimento(Estabelecimento $estabelecimento)
    {
        $pratosCardapio = [];
        $cardapios = Cardapio::where([
            ['estabelecimento_id', $estabelecimento->id]
        ])->get();

        foreach ($cardapios as $cardapio)
        {
            $pratosCardapio[$cardapio->id] = Prato::where([
                ['cardapio', $cardapio->id]
            ])->get();
        }

        return view('estabelecimento.editar',
            ['usuario' => Auth::user(), 'estabelecimento' => $estabelecimento, 'cardapios' => $cardapios, 'pratosCardapio' => $pratosCardapio ]);
    }

    public function editar(Request $request, Estabelecimento $estabelecimento)
    {
        $user = Auth::user();
        $estabelecimento = Estabelecimento::find($estabelecimento->id);

        if($request->input('nome')) $estabelecimento->nome = $request->input('nome');
        if($request->input('endereco')) $estabelecimento->endereco = $request->input('endereco');
        if($request->input('telefone')) $estabelecimento->telefone = $request->input('telefone');

        $estabelecimento->save();

        return $this->editarEstabelecimento($estabelecimento);
    }

    /*
     * Com essa função, é possível acessar o estabelecimento através de uma slug, ao invés do ID na url
    public function getRouteKeyName() {
        return 'slug'
    }
    */
}
