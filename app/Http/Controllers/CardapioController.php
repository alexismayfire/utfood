<?php

namespace App\Http\Controllers;

use App\Cardapio;
use App\Estabelecimento;
use App\TipoCozinha;
use Carbon\CarbonPeriod;
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
        } else {
            $cardapio = Cardapio::find($cardapio->id);
        }

        $cardapio->nome = $request->input('nome');
        $cardapio->pontos = $request->input('pontos');
        $cardapio->estabelecimento_id = $estabelecimento->id;
        $cardapio->save();

        $cardapios = Cardapio::where([
            ['estabelecimento_id', $estabelecimento->id]
        ])->get();

        foreach ($cardapios as $cardapio)
        {
            $pratosCardapio[$cardapio->id] = Prato::where([
                ['cardapio', $cardapio->id]
            ])->get();
        }

        return redirect()->route('editar_estabelecimento_view', compact('estabelecimento'));
    }

    public function viewCriarEditar(Estabelecimento $estabelecimento, Cardapio $cardapio) {

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

    public function removerCardapio(Estabelecimento $estabelecimento, Cardapio $cardapio) {
        $cardapio->delete();

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

    public function exibir() {

    }
}
