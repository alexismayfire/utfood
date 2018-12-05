@extends('layouts.base')

@section('content')
    <div class="column">
        <div class="ui centered vertically padded grid">
            <div class="ten wide column">
                <div class="ui segment raised padded">
                    <h2 class="ui dividing header">Estabelecimentos</h2>
                    @php
                        /*
                        if (route('filtrar_estabelecimentos') == url()->current()) {
                            $params = explode('?', url()->full());
                            $temp = $params[1];
                            $params = explode('&', $temp);
                            if (count($params) == 2) {
                                var_dump($params);
                            }
                        }
                        */
                    @endphp
                    <div class="ui basic placeholder segment">
                        <div class="ui two column stackable center aligned grid">
                            <div class="middle aligned row">
                                <div class="column">
                                    <div class="ui icon header">
                                        <i class="search icon"></i>
                                        Buscar por nome
                                    </div>
                                    <div class="ui category search">
                                        <div class="ui icon input">
                                            <input class="prompt" type="text" placeholder="Digite um termo...">
                                            <i class="search icon"></i>
                                        </div>
                                        <div class="results"></div>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="ui icon header">
                                        <i class="world icon"></i>
                                        Buscar por categorias e avaliações
                                    </div>
                                    <button class="ui button center aligned" id="filtrar-estabelecimentos">
                                        Filtrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ui divider"></div>
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
                                        <p>{{ $estabelecimento->descricao }}</p>
                                    </div>
                                    <div class="extra">
                                        <a class="ui right floated primary button" href="{{ route('estabelecimento', ['estabelecimento' => $estabelecimento]) }}">
                                            Ver
                                            <i class="right chevron icon"></i>
                                        </a>
                                        <span class="ui left floated">
                                            <i class="green check icon"></i>
                                            {{ $estabelecimento->avaliacoes->count() }} avaliações
                                        </span>
                                        <span class="ui left floated">
                                            <i class="yellow star icon"></i>
                                            {{ number_format($estabelecimento->avaliacoes->avg('estrelas'), 2) }} avaliação média
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
