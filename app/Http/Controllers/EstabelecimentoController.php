<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estabelecimento;

class EstabelecimentoController extends Controller
{
    public function showAll()
    {
        return view('estabelecimento.list', ['estabelecimentos' => Estabelecimento::all()]);
    }

    public function show(Estabelecimento $estabelecimento)
    {
        return view('estabelecimento.profile', ['estabelecimento' => $estabelecimento]);
    }

    /*
     * Com essa função, é possível acessar o estabelecimento através de uma slug, ao invés do ID na url
    public function getRouteKeyName() {
        return 'slug'
    }
    */
}
