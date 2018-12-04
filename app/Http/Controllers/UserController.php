<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Avaliacao;
use App\Cardapio;
use App\Estabelecimento;
use App\Prato;
use App\Reserva;
use App\User;

class UserController extends Controller
{
    public function __construct() {
        // $this->middleware('auth');
    }

    /*
    public function show($id)
    {
        return view('user.show', ['user' => User::find($id)]);
    }
    */

    public function exibirTodos()
    {
        return view('user.list', ['usuarios' => User::all()]);
    }

    public function exibir(User $usuario)
    {
        return view('user.profile', ['usuario' => $usuario]);
    }

    public function conta()
    {
        return view('user.profile', ['usuario' => Auth::user(), 'data' => '']);
    }

    public function editarConta(Request $request)
    {
        $user = Auth::user();
        $props = ['name', 'email', 'telefone'];

        foreach($props as $key) {
            if ($request->filled($key)) {
                $user->$key = $request->input($key);
            }
        }

        $user->save();

        return view('user.profile', ['usuario' => $user]);
    }

    public function reservas()
    {
        $usuario = Auth::user();
        $reservaController = new ReservaController();
        $reservas = $reservaController->reservasUsuario($usuario);

        return view('user.reservas', compact('usuario', 'reservas'));
    }

    public function gerenciarEstabelecimentos()
    {
        $user = Auth::user();
        $estabelecimentos = Estabelecimento::join('user_estabelecimento', function($join)
        {
            $join->on('user_estabelecimento.estabelecimento', '=', 'estabelecimentos.id');
        })->where('user_estabelecimento.user', $user->id)
          ->get();

        $avaliacoes[] = [];
        foreach ($estabelecimentos as $estabelecimento)
        {
            $avaliacoes[$estabelecimento->id] = Avaliacao::where([
                ['tipos_conteudo', 1], ['tipo_conteudo_id', $estabelecimento->estabelecimento]
            ])->count();
        }

        return view('estabelecimento.list_user', ['estabelecimentos' => $estabelecimentos, 'avaliacoesCount' => $avaliacoes]);
    }

    public function editarEstabelecimento(Estabelecimento $estabelecimento)
    {
        $pratosCardapio = [];
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
}
