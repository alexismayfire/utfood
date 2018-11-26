@extends('layouts.base')

@section('content')
    <div>
        <div class="title m-b-md">
            Estabelecimentos
        </div>
        <div class="row justify-content-center">
            @foreach($estabelecimentos as $estabelecimento)
                @php
                    if(($loop->iteration - 1) % 3 == 0 || $loop->iteration == 1) {
                    echo '<div class="row justify-content-center">';
                        }
                @endphp
                <div class="col-sm-3">
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
                            <a href="{{ route('estabelecimento', ['estabelecimento' => $estabelecimento]) }}" class="btn btn-primary">Visit</a>
                        </div>
                    </div>
                </div>
                @php
                    if($loop->iteration % 3 == 0) {
                    echo '</div>';
                }
                @endphp
            @endforeach
        </div>
    </div>
@endsection
