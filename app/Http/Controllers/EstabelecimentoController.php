<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estabelecimento;

class EstabelecimentoController extends Controller
{
    public function list()
    {
        return view('estabelecimento.list', ['estabelecimento' => Estabelecimento::all()]);
    }
}
