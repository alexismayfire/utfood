@extends('layouts.base')

@section('content')
    <div class="column">
        <div class="ui centered vertically padded grid">
            <div class="sex wide column">
                <div class="ui segment raised padded">
                    <h2 class="ui dividing header">Editar Estabelecimento - {{$estabelecimento->nome}}</h2>
                    <h3 class="ui dividing header">Editar Cardápios</h3>
                        <div class="ui grid">
                            @foreach($estabelecimento->cardapios as $cardapio)
                                <div class="ui four wide column">
                                    <div class="column">
                                        <h4>{{$cardapio->nome}}</h4>
                                        <p>Pontos: {{$cardapio->pontos}}</p>
                                    </div>
                                    <div class="column">
                                        <a class="ui primary button"
                                           href="{{ route('editar_cardapio_view', ['estabelecimento' => $estabelecimento, 'cardapio' => $cardapio])}}">
                                            Editar
                                        </a>
                                        <a class="ui red button"
                                           href="{{ route('remover_cardapio', ['estabelecimento' => $estabelecimento, 'idCardapio' => $cardapio->id])}}">
                                            <i class="right x icon"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        <div class="sixteen wide column left floated">
                            <a class="ui right floated primary button" href="{{ route('criar_cardapio_view', ['estabelecimento' => $estabelecimento, 'cardapio' => null])}}">
                                Novo Cardápio
                                <i class="right plus icon"></i>
                            </a>
                        </div>
                    </div>
                    <h3 class="ui dividing header">Editar Informações</h3>
                    <form class="ui form" method="POST" action="{{ route('editar_estabelecimento_post', ['estabelecimento' => $estabelecimento]) }}">
                        @csrf
                        <div class="required field">
                            <label for="nome">Nome: </label>
                            <input type="text" name="nome" id="nome" value="{{ $estabelecimento->nome }}"/>
                        </div>
                        <div class="required field">
                            <label for="endereco">Endereço: </label>
                            <input type="text" name="endereco" id="endereco" value="{{ $estabelecimento->endereco }}"/>
                        </div>
                        <div class="required field">
                            <label>Tipo de Cozinha:</label>
                            <select class="ui fluid dropdown" name="tipo_cozinha">
                                <option value="1" {{ $estabelecimento->tipoCozinha->id == 1 ? 'selected="selected"' : '' }}>Japonesa</option>
                                <option value="2" {{ $estabelecimento->tipoCozinha->id == 2 ? 'selected="selected"' : '' }}>Italiana</option>
                                <option value="3" {{ $estabelecimento->tipoCozinha->id == 3 ? 'selected="selected"' : '' }}>Sanduíches</option>
                                <option value="4" {{ $estabelecimento->tipoCozinha->id == 4 ? 'selected="selected"' : '' }}>Pizza</option>
                                <option value="5" {{ $estabelecimento->tipoCozinha->id == 5 ? 'selected="selected"' : '' }}>Brasileira</option>
                            </select>
                        </div>
                        <div class="required field">
                            <label>Descrição:</label>
                            <textarea rows="5" name="descricao">{{ $estabelecimento->descricao }}</textarea>
                        </div>
                        <div class="required field">
                            <label for="telefone">Telefone: </label>
                            <input type="text" name="telefone" id="telefone" value="{{ $estabelecimento->telefone }}"/>
                        </div>
                        <button type="submit" class="ui button">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
