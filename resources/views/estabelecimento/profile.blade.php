@extends('layouts.base')

@section('content')
    <div class="column">
        <div class="ui centered vertically padded grid">
            <div class="ten wide column">
                <div class="ui segment raised padded fluid card">
                    <div class="image">
                        <a href="{{ route('estabelecimento', ['estabelecimento' => $estabelecimento]) }}">
                            <img
                                class="card-img-top"
                                src="https://via.placeholder.com/700x300"
                                alt="{{ $estabelecimento->nome }}"
                            >
                        </a>
                    </div>
                    <div class="content">
                        <div class="header">{{ $estabelecimento->nome }}</div>
                        <div class="meta">Japonesa</div>
                        <div class="description text-left">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque id eleifend elit. Suspendisse euismod ligula eget sodales dapibus. Vivamus iaculis sagittis ipsum vel sollicitudin.</p>
                            <p>Quisque non ligula in ex imperdiet pulvinar vitae quis nisl. Sed nec purus enim. Integer luctus accumsan felis eget commodo. Vestibulum tristique iaculis nulla sed malesuada.</p>
                        </div>
                        <div class="extra content">
                            <div class="ui items">
                                @foreach($cardapios as $cardapio)
                                    <div class="item">
                                        <div class="middle aligned content">
                                            <div class="header">
                                                {{ $cardapio->nome }}
                                            </div>
                                            <div class="description">
                                                <div class="ui list">
                                                    @foreach($cardapio->pratos as $prato)
                                                        <div class="item">
                                                            <div class="header">{{ $prato->titulo }}</div>
                                                            {{ $prato->descricao }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="extra">
                                                <a href="#" class="ui right floated button">Reservar</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <a href="{{ route('cardapios', ['estabelecimento' => $estabelecimento]) }}" class="ui basic primary button">Cardápio</a>
                            <div>
                                <h3>Avaliações dos usuários</h3>
                                @foreach($avaliacoes as $avaliacao)
                                    <p>{{ $avaliacao->comentario }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
