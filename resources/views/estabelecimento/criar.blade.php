@extends('layouts.base')

@section('content')
    <div class="column">
        <div class="ui centered vertically padded grid">
            <div class="seix wide column">
                <div class="ui segment raised padded">
                    <h2 class="ui dividing header">Criar Estabelecimento</h2>
                    <form class="ui form" method="POST" action="{{ route('criar_estabelecimento') }}">
                        @csrf
                        <p><strong>{{ $usuario->name }}</strong>, preencha o formulário abaixo para criar um novo estabelecimento:</p>
                        <div class="field">
                            <label for="nome">Nome: </label>
                            <input type="text" name="nome" id="nome" value=""/>
                        </div>
                        <div class="field">
                            <label for="endereco">Endereço: </label>
                            <input type="text" name="endereco" id="endereco" value=""/>
                        </div>
                        <div class="field">
                            <label for="telefone">Telefone: </label>
                            <input type="text" name="telefone" id="telefone" value=""/>
                        </div>
                        <button type="submit" class="ui button">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
