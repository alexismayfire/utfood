<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Estabelecimento;

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

    public function gerenciarEstabelecimentos()
    {
        $user = Auth::user();
        $estabelecimentos = Estabelecimento::join('user_estabelecimento', function($join)
        {
            $join->on('user_estabelecimento.estabelecimento', '=', 'estabelecimentos.id');
        })
            ->where('user_estabelecimento.user', $user->id)
            ->get();

        return view('estabelecimento.list_user', ['estabelecimentos' => $estabelecimentos]);
    }
}
