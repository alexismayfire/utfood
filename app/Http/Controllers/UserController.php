<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function showAll()
    {
        return view('user.list', ['users' => User::all()]);
    }

    public function show(User $usuario)
    {
        return view('user.profile', ['user' => $usuario]);
    }
}
