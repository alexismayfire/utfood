@extends('layouts.base')

@section('style')
    <link href="{{ asset('css/datepicker/default.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/datepicker/default.date.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('script')
    <script src="{{ asset('js/legacy.js') }}"></script>
    <script src="{{ asset('js/picker.js') }}"></script>
    <script src="{{ asset('js/picker.date.js') }}"></script>
@endsection

@section('content')
<div class="column">
    <div class="ui centered vertically padded grid">
        <div class="ten wide column">
            <div class="ui segment raised padded fluid card">
                <div class="content">
                    <h1 class="ui header">{{ $estabelecimento->nome }}</h1>
                    <div class="meta">Japonesa</div>
                    <div class="description text-left">
                        <p>Você está efetuando uma reserva do cardápio {{ $cardapio->nome }}.</p>
                        <p>Escolha uma data abaixo para verificar os horários disponíveis:</p>
                        <form class="ui form" method="post" action="{{ route('reservas', ['estabelecimento' => $estabelecimento, 'cardapio' => $cardapio]) }}">
                            @csrf
                            <input type="hidden" name="estabelecimento" value="{{ $estabelecimento->id }}" disabled>
                            <input type="hidden" name="cardapio" value="{{ $cardapio->id }}" disabled>
                            <div class="ui centered horizontally grid">
                                <div class="column row">
                                    <div class="field">
                                        <input type="text" name="data" id="data-reserva">
                                    </div>
                                </div>
                                <div class="column row">
                                    <button class="ui button left floated" id="verificar-horarios">Verificar Horários</button>
                                    <div class="ui grouped fields center aligned" id="horarios-disponiveis"></div>
                                </div>
                                <div class="column row">
                                    <button type="submit" class="ui button disabled right floated">Reservar</button>
                                </div>
                            </div>
                        </form>
                        @if(!empty($horarioCheio))
                            <div class="ui error message">
                                <i class="close icon"></i>
                                <div class="header">Não existem vagas nesse horário!</div>
                                Desculpe, mas o horário solicitado foi esgotado. Por favor, tente reservar novamente em outro horário.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
