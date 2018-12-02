@extends('layouts.base')

@section('content')
    <div class="column">
        <div class="ui centered vertically padded grid">
            <div class="sex wide column">
                <div class="ui segment raised padded">
                    <h2 class="ui dividing header">Editar Estabelecimento - {{$estabelecimento->nome}}</h2>
                    <h3 class="ui dividing header">Editar Cardápios</h3>
                        <div class="ui grid">
                            @foreach($cardapios as $cardapio)
                                <div class="ui four wide column">
                                    <div class="column">
                                        <h4>{{$cardapio->nome}}</h4>
                                        <p>Pontos: {{$cardapio->pontos}}</p>
                                    </div>
                                    <div class="column">
                                        <a class="ui primary button"
                                           href="{{ route('criar_cardapio_view', ['estabelecimento' => $estabelecimento, 'cardapio' => $cardapio])}}">
                                            <i class="right chevron icon"></i>
                                        </a>
                                        <a class="ui red button"
                                           href="{{ route('criar_cardapio_view', ['estabelecimento' => $estabelecimento, 'cardapio' => $cardapio])}}">
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
