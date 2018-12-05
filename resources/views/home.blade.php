@extends('layouts.base')

@section('content')
@auth
<div class="column">
    <div class="ui centered vertically padded grid">
        <div class="ten wide column">
            <div class="ui feed segment raised padded">
                <h2 class="ui dividing header">Feed de notícias</h2>
                <div class="event">
                    <div class="label">
                        <i class="user huge icon"></i>
                    </div>
                    <div class="content">
                        <div class="summary">
                            <a class="user">
                                Elliot Fu
                            </a> added you as a friend
                            <div class="date">
                                1 Hour Ago
                            </div>
                        </div>
                        <div class="meta">
                            <a class="like">
                                <i class="like icon"></i> 4 Likes
                            </a>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="label">
                        <i class="user huge icon"></i>
                    </div>
                    <div class="content">
                        <div class="summary">
                            <a>Joe Henderson</a> posted on his page
                            <div class="date">
                                3 days ago
                            </div>
                        </div>
                        <div class="extra text">
                            Ours is a life of constant reruns. We're always circling back to where we'd we started, then starting all over again. Even if we don't run extra laps that day, we surely will come back for more of the same another day soon.
                        </div>
                        <div class="meta">
                            <a class="like">
                                <i class="like icon"></i> 5 Likes
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="column">
    <div class="ui vertical masthead center aligned segment">
        <div class="ui text container">
            <div class="ui placeholder basic segment ">
                <div class="ui two column stackable center aligned grid">
                    <div class="ui vertical divider">Ou</div>
                    <div class="middle aligned row">
                        <div class="column">
                            <div class="ui icon header">
                                <i class="search icon"></i>
                                Navegue pelos estabelecimentos
                            </div>
                            <a class="ui primary button" href="{{ route('login') }}">
                                Entrar
                            </a>
                        </div>
                        <div class="column">
                            <div class="ui icon header">
                                <i class="world icon"></i>
                                Registre-se no UTFood
                            </div>
                            <a class="ui primary button" href="{{ route('register') }}">
                                Registrar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endauth
@endsection
