@extends('layouts.base')

@section('content')
    <div class="column">
        <div class="ui centered vertically padded grid">
            <div class="ui middle aligned grid padded">
                <div class="twelve wide column content text-left">
                    <h3 class="ui header center aligned">Usuários</h3>
                    <div class="description text-left">
                        <div class="ui list relaxed">
                            @foreach($usuarios as $user)
                                <div class="item">
                                    <div class="twelve wide column content text-left">
                                        <div class="header">{{ $user->name }}</div>
                                        <p>{{ $user->email }}</p>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="four wide column center aligned">
                    <a href="#" class="ui button">Editar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
