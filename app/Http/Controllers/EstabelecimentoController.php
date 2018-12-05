<?php

namespace App\Http\Controllers;

use App\TipoCozinha;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Avaliacao;
use App\Cardapio;
use App\Estabelecimento;
use App\UserEstabelecimento;
use App\Favorito;
use App\Prato;

class EstabelecimentoController extends Controller
{
    private $tipoConteudo = 1;

    public function exibirTodos()
    {
        $estabelecimentos = Estabelecimento::all();
        $tiposCozinha = TipoCozinha::all();

        return view('estabelecimento.list', compact('estabelecimentos', 'tiposCozinha'));
    }

    public function filtrar(Request $request)
    {
        $estabelecimentos = Estabelecimento::query();
        $tipoCozinha = $request->query->get('tipo-cozinha');
        $avaliacoes = $request->query->get('avaliacoes');
        $nome = $request->query->get('nome');

        if ($nome)
        {
            $estabelecimentos = $estabelecimentos->where('nome', 'ilike', '%' . $nome . '%')->get();

            return response()->json(['estabelecimentos' => $estabelecimentos]);
        }

        if ($tipoCozinha)
        {
            $estabelecimentos = $estabelecimentos->where('estabelecimentos.tipo_cozinha_id', (int)$tipoCozinha);
        }

        if ($avaliacoes)
        {
            $estabelecimentos = $estabelecimentos->with('avaliacoes')->get();
            $temp = new Collection;
            foreach($estabelecimentos as $estabelecimento) {
                if ($estabelecimento->avaliacoes->avg('estrelas') >= $avaliacoes) {
                    $temp[] = $estabelecimento;
                }
            }

            $estabelecimentos = $temp;
        }
        else
        {
            $estabelecimentos = $estabelecimentos->get();
        }

        $tiposCozinha = TipoCozinha::all();

        return view('estabelecimento.list', compact('estabelecimentos', 'tiposCozinha'));
    }

    public function exibir(Estabelecimento $estabelecimento)
    {
        $usuario = \Auth::user();

        $favoritos = Favorito::where([['user', $usuario->id], ['tipos_conteudo', 1]])
            ->join('estabelecimentos', 'estabelecimentos.id', '=', 'favoritos.tipo_conteudo_id')
            ->select('estabelecimentos.id')
            ->get();

        return view('estabelecimento.profile', compact('estabelecimento', 'usuario', 'favoritos'));
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
