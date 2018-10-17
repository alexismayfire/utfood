<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /*
    public function show($id)
    {
        return view('user.show', ['user' => User::find($id)]);
    }
    */

    public function list()
    {
        return view('user.list', ['users' => User::all()]);
    }
}
