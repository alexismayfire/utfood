@extends('layouts.base')

@section('content')
    <div class="column">
        <div class="ui centered vertically padded grid">
            <div class="six wide column">
                <div class="ui segment raised padded">
                    <h2 class="ui dividing header">Minhas Reservas</h2>
                    <div class="ui divided items">
                        @foreach($reservas as $reserva)
                            <div class="item">
                                <div class="content">
                                    <a class="header" href="{{ route('estabelecimento', [$reserva->cardapio->estabelecimento->id]) }}">{{ $reserva->cardapio->estabelecimento->nome }}</a>
                                    <div class="meta"><i class="clock outline small icon"></i> reservado {{ $reserva->created_at->diffForHumans() }}</div>
                                    <div class="description text-left">
                                        <p><span class="font-weight-bold"><i class="utensils icon"></i> Cardápio: </span> {{ $reserva->cardapio->nome }}</p>
                                        <p><span class="font-weight-bold"><i class="calendar alternate icon"></i> Horário: </span>{{ $reserva->data->format('d/m/Y \à\s H\h') }}</p>
                                    </div>
                                    <div class="extra">
                                        <div class="ui label left floated {{ $reserva->status ? 'green' : 'red' }}"><i class="ticket icon"></i> {{ $reserva->status ? 'Reservado' : 'Cancelado' }}</div>
                                        @if($reserva->pontos)
                                            <div class="ui label left floated purple"><i class="certificate icon"></i>{{ $reserva->pontos }} pontos acumulados</div>
                                        @endif
                                        <a class="ui right floated primary button" href="#">Cancelar<i class="right chevron icon"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
