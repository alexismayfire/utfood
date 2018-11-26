@extends('layouts.base')

@section('content')
    <div>
        <div class="title m-b-md">
            {{ $estabelecimento->nome }}
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <a href="{{ route('estabelecimento', ['estabelecimento' => $estabelecimento]) }}">
                        <img
                            class="card-img-top"
                            src="https://via.placeholder.com/350x150"
                            alt="{{ $estabelecimento->nome }}"
                        >
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $estabelecimento->nome }}</h5>
                        <p class="card-text">Lorem ipsum</p>
                        <a href="{{ route('cardapios', ['estabelecimento' => $estabelecimento]) }}" class="btn btn-primary">Cardápios</a>
                    </div>
                </div>
                <div>
                    <h3>Avaliações dos usuários</h3>
                    @foreach($avaliacoes as $avaliacao)
                        <p>{{ $avaliacao->comentario }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
