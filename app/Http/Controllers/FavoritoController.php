<?php

namespace App\Http\Controllers;

use App\Estabelecimento;
use App\Favorito;
use Illuminate\Http\Request;

class FavoritoController extends Controller
{
    public function estabelecimento(Estabelecimento $estabelecimento)
    {
        $user = \Auth::user();
        $existe = Favorito::where([
            ['user', $user->id], ['tipos_conteudo', 1], ['tipo_conteudo_id', $estabelecimento->id]
        ])->get();

        if ($existe->isEmpty())
        {
            $favorito = new Favorito;

            $favorito->user = $user->id;
            $favorito->tipos_conteudo = 1;
            $favorito->tipo_conteudo_id = $estabelecimento->id;
            $favorito->save();
        }
        else
        {
            $existe->delete();
        }

        return redirect()->route('estabelecimento', compact('estabelecimento', 'user'));
    }

    public function estabelecimentosUsuario()
    {
        $user = \Auth::user();
        $favoritos = Favorito::where([['user', $user->id], ['tipos_conteudo', 1]])
            ->join('estabelecimentos', 'estabelecimentos.id', '=', 'favoritos.tipo_conteudo_id')
            ->get();

        return view('user.favoritos', compact('favoritos', 'user'));
    }
}
