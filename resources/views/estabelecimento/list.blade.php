@extends('layouts.base')

@section('content')
    <div class="column">
        <div class="ui centered vertically padded grid">
            <div class="ten wide column">
                <div class="ui segment raised padded">
                    <h2 class="ui dividing header">Estabelecimentos</h2>
                    <div class="ui centered grid">
                        <div class="column eight wide">
                            <div class="ui category search">
                                    <div class="ui fluid icon input">
                                        <input class="prompt" type="text" placeholder="Digite um termo para buscar...">
                                        <i class="search icon"></i>
                                    </div>
                                <div class="results"></div>
                            </div>
                        </div>
                    </div>
                    <div class="ui divided items">
                        @foreach($estabelecimentos as $estabelecimento)
                            <div class="item">
                                <div class="ui image">
                                    <a href="{{ route('estabelecimento', ['estabelecimento' => $estabelecimento]) }}">
                                        <img
                                            src="https://via.placeholder.com/200x200"
                                            alt="{{ $estabelecimento->nome }}"
                                        >
                                    </a>
                                </div>
                                <div class="content">
                                    <div class="header">{{ $estabelecimento->nome }}</div>
                                    <div class="meta">
                                        <span class="cozinha">{{ $estabelecimento->tipoCozinha->titulo }}</span>
                                    </div>
                                    <div class="description text-left">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque id eleifend elit. Suspendisse euismod ligula eget sodales dapibus. Vivamus iaculis sagittis ipsum vel sollicitudin.</p>
                                        <p>Quisque non ligula in ex imperdiet pulvinar vitae quis nisl. Sed nec purus enim. Integer luctus accumsan felis eget commodo. Vestibulum tristique iaculis nulla sed malesuada.</p>
                                    </div>
                                    <div class="extra">
                                        <a class="ui right floated primary button" href="{{ route('estabelecimento', ['estabelecimento' => $estabelecimento]) }}">
                                            Ver
                                            <i class="right chevron icon"></i>
                                        </a>
                                        <span class="ui left floated">
                                            <i class="green check icon"></i>
                                            {{$avaliacoesCount[$estabelecimento->id]}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
            </div>
        </div>
    </div>
@endsection
