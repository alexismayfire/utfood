@extends('layouts.base')

@section('content')
<div class="column">
    <div class="ui centered vertically padded grid">
        <div class="six wide column">
            <div class="ui segment raised padded">
                <h2 class="ui dividing header">Meus Favoritos</h2>
                @if($favoritos)
                    <div class="ui divided items">
                        @foreach($favoritos as $favorito)
                            <div class="item">
                                <div class="content">
                                    <a class="header" href="{{ route('estabelecimento', [$favorito->tipo_conteudo_id]) }}">{{ $favorito->nome }}</a>
                                    <div class="meta"><i class="clock outline small icon"></i> favoritado {{ $favorito->created_at->diffForHumans() }}</div>
                                    <div class="description text-left"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    <div class="ui tiny modal">
        <div class="ui icon header">
            <i class="calendar times outline icon"></i>
            Cancelar Reserva
        </div>
        <div class="content">
        <p>Tem certeza que deseja cancelar a reserva para o dia <span id="horario-reserva"></span>, em <span id="estabelecimento-reserva"></span>?</p>
        </div>
        <form class="actions" action="" method="post" id="cancelarReservaUsuario">
            @csrf
            <div class="ui gray cancel button">
                <i class="remove icon"></i>
                Voltar
            </div>
            <button class="ui red ok button" type="submit">
                <i class="checkmark icon"></i>
                Cancelar
            </button>
        </form>
    </div>
@endsection
