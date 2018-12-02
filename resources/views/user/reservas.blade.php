@extends('layouts.base')

@section('content')
    <div class="column">
        <div class="ui centered vertically padded grid">
            <div class="six wide column">
                <div class="ui segment raised padded">
                    <h2 class="ui dividing header">Minhas Reservas</h2>
                    <div class="ui list">
                        @foreach($reservas as $reserva)
                            <div class="item">
                                <div class="header">{{ $reserva->data }}</div>
                                <div class="content">
                                    {{ $reserva->cardapio }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
