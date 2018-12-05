<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Avaliacao;
use App\Reserva;

class AvaliacaoController extends Controller
{
    public function avaliarEstabelecimento(Request $request, Reserva $reserva)
    {
        $user = \Auth::user();
        $estabelecimento = $reserva->cardapio->estabelecimento;
        $cardapio = $reserva->cardapio;

        $avaliacao = Avaliacao::where([
            ['usuario', $user->id], ['tipos_conteudo', 1], ['tipo_conteudo_id', $estabelecimento->id]
        ])->get()->first();

        if (!$avaliacao->id)
        {
            $estrelas = (int)$request->input('estrelas');
            $comentario = $request->input('comentario');

            if ($request->method() == 'POST' && $estrelas > 0)
            {
                $avaliacao = new Avaliacao;
                $avaliacao->usuario = $user->id;
                $avaliacao->estrelas = $estrelas;
                $avaliacao->tipos_conteudo = 1;
                $avaliacao->tipo_conteudo_id = $estabelecimento->id;

                if($comentario)
                {
                    $avaliacao->comentario = $comentario;
                }

                $avaliacao->save();
            $avaliacao = $avaliacao->first();

                return redirect()->route('minhas_reservas');
            }
            else
            {
                return view('user.avaliar', compact('user', 'estabelecimento', 'cardapio', 'reserva', 'estrelas'));
            }
        }
        else
        {
            return view('user.avaliar', compact('user', 'estabelecimento', 'cardapio', 'reserva', 'avaliacao'));
        }
    }
}
