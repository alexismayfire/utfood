@extends('layouts.base')

@section('content')
    <div class="column">
        <div class="ui centered vertically padded grid">
            <div class="ten wide column">
                <div class="ui segment raised padded fluid card">
                    <div class="image">
                        <form action="{{ route('favoritar_estabelecimento', ['estabelecimento' => $estabelecimento]) }}" id="favoritar-estabelecimento" method="post">
                            @csrf
                            <a class="ui right corner big label" onclick="event.preventDefault();document.getElementById('favoritar-estabelecimento').submit()">
                                @foreach($favoritos as $favorito)
                                    @if($favorito->id === $estabelecimento->id)
                                        @php
                                            $fav = true;
                                        @endphp
                                    @endif
                                @endforeach
                                @if(isset($fav))
                                    <i class="heart red icon"></i>
                                @else
                                    <i class="heart icon"></i>
                                @endif

                            </a>
                        </form>
                        <img
                            src="https://via.placeholder.com/700x300"
                            alt="{{ $estabelecimento->nome}}"
                        >
                    </div>
                    <div class="content">
                        <h1 class="ui header">{{ $estabelecimento->nome }}</h1>
                        <div class="meta">{{ $estabelecimento->tipoCozinha->titulo }}</div>
                        <div class="description text-left">
                            {{ $estabelecimento->descricao }}
                        </div>
                    </div>
                    <h2 class="ui horizontal divider header"><i class="utensils mini icon"></i>Cardápios</h2>
                    <div class="items">
                        @foreach($estabelecimento->cardapios as $cardapio)
                            <div class="item">
                                <div class="content">
                                    @include('estabelecimento.cardapio')
                                    @if(!$loop->last)
                                        <div class="ui divider"></div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <h2 class="ui horizontal divider header"><i class="star mini icon"></i>Avaliações</h2>
                    <div>
                        @foreach($estabelecimento->avaliacoes as $avaliacao)
                            <div class="item">
                                <div class="content">
                                    @include('estabelecimento.avaliacoes')
                                    @if(!$loop->last)
                                        <div class="ui divider"></div>
                                    @endif
                                </div>
                        @endforeach
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
