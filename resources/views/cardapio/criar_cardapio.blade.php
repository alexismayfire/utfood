@extends('layouts.base')

@section('content')
    <div class="column">
        <div class="ui centered vertically padded grid">
            <div class="seix wide column">
                <div class="ui segment raised padded">
                    @if($cardapio->id == null)
                    <h2 class="ui dividing header">Criar cardápio para {{$estabelecimento->nome}}</h2>
                    @else
                    <h2 class="ui dividing header">Editar Cardápio - {{$cardapio->nome}}</h2>
                    @endif
                        <form class="ui form" method="POST" action="{{ route('criar_cardapio_post', ['estabelecimento' => $estabelecimento]) }}">
                            <div class="ui grid">
                                @csrf
                                @if($cardapio->id == null)
                                <h3>Criar novo cardápio para {{$estabelecimento->nome }}</h3>
                                @endif
                                <div class="twelve wide column">
                                    <label for="nome">Nome: </label>
                                    <input type="text" name="nome" id="nome" value=""/>
                                </div>
                                <div class="two wide column left floated">
                                    <label for="pontos">Pontos: </label>
                                    <input type="number" name="pontos" id="pontos" value=""/>
                                </div>
                                <div class="two wide column">
                                    <label>Salvar: </label>
                                    <button type="submit" class="ui button">Salvar</button>
                                </div>
                            </div>
                        </form>
                    <h3 class="ui dividing header">Pratos: </h3>
                    @if (!$pratos->isEmpty())
                        <div class="ui one column divided grid">
                            @foreach($pratos as $prato)
                                <div class="row">
                                    <div class="column">
                                        <p>Batata</p>
                                    </div>
                                    <div class="column">
                                        <p>Batata</p>
                                    </div>
                                    <div class="column">
                                        <p>Batata</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>Você não possui nenhum prato registrado ainda</p>
                    @endif
                    @if ($cardapio->id != null)
                    <h4 class="ui header">Adicionar prato: </h4>
                    <form class="ui form" method="POST" action="{{ route('criar_prato', ['estabelecimento' => $estabelecimento, 'cardapio' => $cardapio]) }}">
                        <div class="ui grid">
                            <div class="six wide column right floated">
                                <label for="titulo">Título: </label>
                                <input type="text" name="titulo" id="titulo" value=""/>
                            </div>
                            <div class="six wide column">
                                <label for="tipo">Tipo de Cozinha: </label>
                                <select class="ui dropdown" id="tipo">
                                    <option value="1">Male</option>
                                    <option value="0">Female</option>
                                    @foreach($tiposCozinha as $tipo)
                                        <div class="item" data-value="{{$tipo->id}}">{{$tipo->titulo}}</div>
                                    @endforeach
                                </select>
                            </div>
                            <div class="two wide column left floated">
                                <label for="preco">Pontos: </label>
                                <input type="number" name="preco" id="preco" value=""/>
                            </div>
                        </div>
                        <div class="ui grid">
                            <div class="fourteen wide column centered">
                                <label for="descricao">Descrição: </label>
                                <input type="text" name="descricao" id="descricao" value=""/>
                            </div>
                            <div class="two wide column">
                                <label for="button" >Add</label>
                                <button type="submit" class="ui primary button">
                                    <i class="right check icon"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    @else
                        <p>Para cadastrar pratos antes confirme o cadastro do cardápio</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
