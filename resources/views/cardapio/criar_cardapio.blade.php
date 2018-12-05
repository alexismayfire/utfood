@extends('layouts.base')

@section('content')
    <div class="column">
        <div class="ui centered vertically padded grid">
            <div class="seix wide column">
                <div class="ui segment raised padded">
                    <div class="ui basic segment">
                        @if($cardapio->id == null)
                            <h2 class="ui left floated header">Criar cardápio para {{$estabelecimento->nome}}</h2>
                        @else
                            <h2 class="ui left floated header">Editar Cardápio - {{$cardapio->nome}}</h2>
                        @endif
                        <div class="ui clearing divider"></div>
                        <form class="ui form" method="POST" action="{{ route('criar_cardapio_post', ['estabelecimento' => $estabelecimento, 'cardapio' => $cardapio]) }}">
                            @csrf
                            <div class="ui grid">
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
                    </div>
                    <div class="ui divider hidden"></div>
                    <div>
                        @if(!$pratos->isEmpty())
                            <div class="ui basic segment">
                                <h2 class="ui horizontal divider header">
                                    <i class="bar utensil spoon icon"></i>
                                    Pratos
                                </h2>
                                <div class="ui list">
                                    @foreach($pratos as $prato)
                                        <div class="item">
                                            <div class="ui grid two columns">
                                                <div class="fourteen wide column">
                                                    <table class="ui definition table">
                                                        <tbody>
                                                        <tr>
                                                            <td class="two wide column">Título</td>
                                                            <td>{{$prato->titulo}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="two wide column">Preço</td>
                                                            <td>{{$prato->preco}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="two wide column">Descricao</td>
                                                            <td>{{$prato->descricao}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="two wide column">
                                                    <div class="ui divider hidden"></div>
                                                    <div class="ui divider hidden"></div>
                                                    <form id="remover-prato" method="post" action="{{ route('remover_prato', compact('estabelecimento', 'cardapio', 'prato')) }}">
                                                        @csrf
                                                        <a class="ui red button fluid" onclick="event.preventDefault();document.getElementById('remover-prato').submit()">
                                                            <i class="x icon center"></i>
                                                        </a>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <p>Você não possui nenhum prato registrado ainda</p>
                        @endif
                    </div>


                    @if ($cardapio->id != null)
                    <div class="ui segment" style="margin-top: 30px;">
                        <h2 class="ui right floated header">Adicionar prato</h2>
                        <div class="ui clearing divider"></div>
                        <form class="ui form" method="POST" action="{{ route('criar_prato', ['estabelecimento' => $estabelecimento, 'cardapio' => $cardapio]) }}">
                            @csrf
                            <div class="ui grid">
                                <div class="six wide column right floated">
                                    <label for="titulo">Título: </label>
                                    <input type="text" name="titulo" id="titulo" value=""/>
                                </div>
                                <div class="four wide column">
                                    <label for="tipo">Tipo de Cozinha: </label>
                                    <select class="ui dropdown" id="tipo" name="tipoCozinha">
                                        @foreach($tiposCozinha as $tipo)
                                            <option value="{{$tipo->id}}">{{$tipo->titulo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="four wide column">
                                    <label for="tipo">Tipo do Prato: </label>
                                    <select class="ui dropdown" id="tipo" name="tipoPrato">
                                        <option value="1">Entrada</option>
                                        <option value="2">Prato Principal</option>
                                        <option value="3">Sobremesa</option>
                                        @foreach($tiposCozinha as $tipo)
                                            <option value="{{$tipo->id}}">{{$tipo->titulo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="two wide column left floated">
                                    <label for="preco">Preço: </label>
                                    R$ <input type="number" id="preco" name="preco" step="any">
                                </div>
                            </div>
                            <div class="ui grid">
                                <div class="thirteen wide column centered">
                                    <label for="descricao">Descrição: </label>
                                    <input type="text" name="descricao" id="descricao" value=""/>
                                </div>
                                <div class="two wide column">
                                    <label for="add">Adicionar: </label>
                                    <button type="submit" class="ui primary button" id="add">
                                        <i class="right plus icon"></i>
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
    </div>
@endsection
