@extends('layouts.base')

@section('content')
    <div class="column">
        <div class="ui centered vertically padded grid">
            <div class="ten wide column">
                <div class="ui segment raised padded fluid card">
                    <div class="image">
                        <img
                            src="https://via.placeholder.com/700x300"
                            alt="{{ $estabelecimento->nome}}"
                        >
                    </div>
                    <div class="content">
                        <h1 class="ui header">{{ $estabelecimento->nome }}</h1>
                        <div class="meta">{{ $estabelecimento->tipoCozinha->titulo }}</div>
                        <div class="description text-left">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque id eleifend elit. Suspendisse euismod ligula eget sodales dapibus. Vivamus iaculis sagittis ipsum vel sollicitudin.</p>
                            <p>Quisque non ligula in ex imperdiet pulvinar vitae quis nisl. Sed nec purus enim. Integer luctus accumsan felis eget commodo. Vestibulum tristique iaculis nulla sed malesuada.</p>
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
                        @foreach($avaliacoes as $avaliacao)
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
