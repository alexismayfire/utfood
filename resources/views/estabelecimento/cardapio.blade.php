<div class="ui middle aligned grid padded">
    <div class="twelve wide column content text-left">
        <h3 class="ui header center aligned">{{ $cardapio->nome }}</h3>
        <div class="description text-left">
            <div class="ui list relaxed">
                @foreach($cardapio->pratos as $prato)
                    <div class="item">
                        <div class="twelve wide column content text-left">
                            <div class="header">{{ $prato->titulo }}</div>
                            <p>{{ $prato->descricao }}</p>
                            <div class="ui tiny statistic floated right">
                                <div class="value">R$ {{ $prato->preco }}</div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
    <div class="four wide column center aligned">
        <a href="#" class="ui button">Reservar</a>
    </div>
</div>
