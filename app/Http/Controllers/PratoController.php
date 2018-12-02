<?php

namespace App\Http\Controllers;

use App\Cardapio;
use App\Estabelecimento;
use Illuminate\Http\Request;

class PratoController extends Controller
{
    public function criar(Request $request, Cardapio $cardapio, Estabelecimento $estabelecimento)
    {
        $user = Auth::user();
        $prato = new Prato;

        $prato->titulo = $request->input('nome');
        $prato->descricao = $request->input('descricao');
        $prato->tipo_cozinha = $request->input('tipo');
        $prato->preco = $request->input('preco');
        $prato->cardapio = $cardapio->id;
        $prato->save();

        $pratosCardapio = [];
        if($cardapio != null) {
            $pratosCardapio = Prato::where([
                ['cardapio', $cardapio->id]
            ])->get();
        }

        $tiposCozinha = [];//TipoCozinha::All(); ARRUMAR DEPOIS - erro ao recuperar tipos

        return view('cardapio.criar_cardapio',
            ['estabelecimento' => $estabelecimento, 'pratos' => $pratosCardapio, 'tiposCozinha' => $tiposCozinha]);
    }
}
