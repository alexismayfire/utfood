@extends('layouts.base')

@section('content')
    <div class="column">
        <div class="ui centered vertically padded grid">
            <div class="six wide column">
                <div class="ui segment raised padded">
                    <h2 class="ui dividing header">Editar Conta</h2>
                    <form class="ui form" method="POST" action="{{ route('editar_conta') }}">
                        @csrf
                        <p><strong>{{ $usuario->name }}</strong>, você pode atualizar seus dados preenchendo os campos que deseja alterar em seu cadastro:</p>
                        <div class="field">
                            <label for="name">Nome: </label>
                            <input type="text" name="name" id="name" placeholder="{{ $usuario->name }}" value=""/>
                        </div>
                        <div class="field">
                            <label for="email">Email: </label>
                            <input type="email" name="email" id="email" placeholder="{{ $usuario->email }}" value="" />
                        </div>
                        <div class="field">
                            <label for="telefone">Telefone: </label>
                            <input type="text" name="telefone" id="telefone" placeholder="{{ $usuario->telefone }}" value=""/>
                        </div>
                        <button type="submit" class="ui button">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
