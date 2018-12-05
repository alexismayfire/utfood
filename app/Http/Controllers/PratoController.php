<?php

namespace App\Http\Controllers;

use App\Cardapio;
use App\Estabelecimento;
use App\Prato;
use App\TipoCozinha;
use Illuminate\Http\Request;

class PratoController extends Controller
{
    public function criarPrato(Request $request, Estabelecimento $estabelecimento, Cardapio $cardapio)
    {
        $prato = new Prato;

        $prato->titulo = $request->input('titulo');
        $prato->descricao = $request->input('descricao');
        $prato->tipo_cozinha = $request->input('tipoCozinha');
        $prato->preco = $request->input('preco');
        $prato->tipo = $request->input('tipoPrato');
        $prato->cardapio = $cardapio->id;
        $prato->save();

        $pratos = [];
        if($cardapio != null) {
            $pratos = Prato::where([
                ['cardapio', $cardapio->id]
            ])->get();
        }

        $tiposCozinha = TipoCozinha::All();

        return view(
            'cardapio.criar_cardapio',
            compact('estabelecimento', 'cardapio', 'pratos', 'tiposCozinha')
        );
    }

    public function removerPrato(Request $request, Estabelecimento $estabelecimento, Cardapio $cardapio, Prato $prato) {
        $prato = Prato::find($prato->id);
        $prato->delete();

        $pratosCardapio = [];
        if($cardapio != null) {
            $pratosCardapio = Prato::where([
                ['cardapio', $cardapio->id]
            ])->get();
        }

        $tipoCozinha = TipoCozinha::All();

        return view('cardapio.criar_cardapio',
            ['estabelecimento' => $estabelecimento, 'cardapio' => $cardapio, 'pratos' => $pratosCardapio, 'tiposCozinha' => $tipoCozinha]);
    }
}
