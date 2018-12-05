@extends('layouts.base')

@section('content')
    <div class="column">
        <div class="ui centered vertically padded grid">
            <div class="six wide column">
                <div class="ui segment raised padded">
                    <h2 class="ui dividing header">Avaliar Estabelecimento</h2>
                    @if(isset($avaliacao))
                        <p>Você já avaliou o estabelecimento <a href="{{ route('estabelecimento', compact('estabelecimento')) }}">{{ $estabelecimento->nome }}</a> {{ $avaliacao->created_at->diffForHumans() }}.</p>
                        <p>Desculpe, mas é permitida apenas uma avaliação por estabelecimento.</p>
                    @else
                        <form class="ui form" id="avaliacaoForm" method="POST" action="{{ route('avaliar_minha_reserva', ['reserva' => $reserva]) }}">
                            @csrf
                            <p><strong>{{ $user->name }}</strong>, você está avaliando sua reserva de {{ $reserva->data->format('d/m/Y \à\s H\h') }}, no estabelecimento {{ $estabelecimento->nome }}.</p>
                            <p>Queremos saber o que você achou do cardápio {{ $cardapio->nome }}:</p>
                            <div class="required field">
                                <label>Avaliação:</label>
                                <div class="ui rating huge" id="avaliacao-rating" data-rating="0" data-max-rating="5"></div>
                                <input type="hidden" name="estrelas" value="">
                            </div>
                            <div class="field">
                                <label>Comentário (opcional):</label>
                                <textarea rows="5" name="comentario"></textarea>
                            </div>
                            <button type="submit" class="ui button">Salvar</button>
                        </form>
                        @if(isset($estrelas) && !$estrelas)
                            <div class="ui error message">
                                <i class="close icon"></i>
                                <div class="header">A escolha de nota é obrigatória</div>
                                Desculpe, mas é preciso escolher uma nota para o estabelecimento. Por favor, cliquen as estrelas para indicar sua nota e tente novamente.
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
