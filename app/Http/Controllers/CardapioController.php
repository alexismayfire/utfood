<?php

namespace App\Http\Controllers;

use App\Cardapio;
use App\Estabelecimento;
use App\TipoCozinha;
use Illuminate\Http\Request;
use App\Prato;
use Illuminate\Support\Facades\Auth;

class CardapioController extends Controller
{
    public function criarOuEditar(Request $request , Estabelecimento $estabelecimento, Cardapio $cardapio)
    {
        $user = Auth::user();
        if($cardapio->id == null) {
            $cardapio = new Cardapio;
        }

        $cardapio->nome = $request->input('nome');
        $cardapio->pontos = $request->input('pontos');
        $cardapio->estabelecimento = $estabelecimento->id;
        $cardapio->save();

        $cardapios = Cardapio::where([
            ['estabelecimento', $estabelecimento->id]
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

    public function viewCriar(Estabelecimento $estabelecimento, Cardapio $cardapio) {

        $pratosCardapio = [];
        if($cardapio != null) {
            $pratosCardapio = Prato::where([
                ['cardapio', $cardapio->id]
            ])->get();
        }

        $tiposCozinha = TipoCozinha::All();

        return view('cardapio.criar_cardapio',
            ['estabelecimento' => $estabelecimento, 'cardapio' => $cardapio, 'pratos' => $pratosCardapio, 'tiposCozinha' => $tiposCozinha]);
    }

    public function exibir() {

    }
}
