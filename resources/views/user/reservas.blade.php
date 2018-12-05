@extends('layouts.base')

@section('content')
<div class="column">
    <div class="ui centered vertically padded grid">
        <div class="six wide column">
            <div class="ui segment raised padded">
                <h2 class="ui dividing header">Minhas Reservas</h2>
                @if($reservas)
                    <div class="ui divided items">
                        @foreach($reservas as $reserva)
                            <div class="item">
                                <div class="content">
                                    <a class="header" href="{{ route('estabelecimento', [$reserva->cardapio->estabelecimento->id]) }}">{{ $reserva->cardapio->estabelecimento->nome }}</a>
                                    <div class="meta"><i class="clock outline small icon"></i> reservado {{ $reserva->created_at->diffForHumans() }}</div>
                                    <div class="description text-left">
                                        <p><span style="font-weight: bold"><i class="utensils icon"></i> Cardápio: </span> {{ $reserva->cardapio->nome }}</p>
                                        <p><span style="font-weight: bold"><i class="calendar alternate icon"></i> Horário: </span>{{ $reserva->data->format('d/m/Y \à\s H\h') }}</p>
                                    </div>
                                    <div class="extra">
                                        @php
                                            $reservaFutura = $reserva->data->addHours(0)->greaterThanOrEqualTo(\Carbon\Carbon::now('America/Sao_Paulo')) ? true : false
                                        @endphp
                                        @if($reservaFutura)
                                            <div class="ui label left floated {{ $reserva->status ? 'green' : 'red' }}"><i class="ticket icon"></i> {{ $reserva->status ? 'Reservado' : 'Cancelado' }}</div>
                                        @else
                                            <div class="ui label left floated {{ $reserva->comparecimento ? 'green' : 'red' }}"><i class="ticket icon"></i> {{ $reserva->comparecimento ? 'Confirmada' : 'Aguardando pontos' }}</div>
                                        @endif
                                        @if($reserva->pontos)
                                            <div class="ui label left floated purple"><i class="certificate icon"></i>{{ $reserva->pontos }} pontos acumulados</div>
                                        @endif
                                        @if($reservaFutura)
                                            <button class="ui right floated red button cancelar reserva"
                                                    data-submit="{{ route('cancelar_minha_reserva', ['reserva' => $reserva->id]) }}"
                                                    data-horario="{{ $reserva->data->format('d/m/Y \à\s H\h') }}"
                                                    data-estabelecimento="{{ $reserva->cardapio->estabelecimento->nome }}"
                                            >
                                                Cancelar<i class="right chevron icon"></i>
                                            </button>
                                        @else
                                            <a class="ui right floated green button" href="{{ route('avaliar_minha_reserva', ['reserva' => $reserva]) }}">
                                                Avaliar<i class="right chevron icon"></i>
                                            </a>
                                        @endif
                                        </span>
                                    </div>
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
