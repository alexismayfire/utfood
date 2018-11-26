<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user->name = $request->input('nome', $user->name);
        $user->email = $request->input('email', $user->email);
        $user->telefone = $request->input('telefone', $user->telefone);

        return dd($request->all());

        // return view('user.profile', ['usuario' => $user, 'data' => $request->post()]);
    }

    public function gerenciarEstabelecimentos()
    {
        return '';
    }
}
