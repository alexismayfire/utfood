@isset($tiposCozinha)
    <div class="ui left vertical menu sidebar">
        <div class="ui basic segment">
            <div class="ui divided list">
                <div class="ui header"></div>
                <div class="ui horizontal divider header"><i class="utensils mini icon"></i>Cardápios</div>
                <div class="item">
                    <div class="ui list">
                        @foreach($tiposCozinha as $tipoCozinha)
                            <div class="item">
                                <div class="ui fluid labeled button">
                                    <a class="ui fluid button" href="{{ route('filtrar_estabelecimentos') }}?tipo-cozinha={{ $tipoCozinha->id }}">{{ $tipoCozinha->titulo }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="ui horizontal divider header"><i class="utensils mini icon"></i>Avaliações</div>
                <div class="item">
                    <div class="ui list">
                        @for($i = 5; $i > 0; $i--)
                            <div class="item">
                                <div class="ui fluid labeled button" tabindex="0">
                                    <a class="ui fluid button" href="{{ route('filtrar_estabelecimentos') }}?avaliacoes={{ $i }}">
                                        {{ $i }}{{ $i < 5 ? '+' : '' }} {{ $i > 1 ? 'estrelas' : 'estrela' }}
                                        <div class="ui rating right floated" id="filtro-rating-{{ $i }}" data-rating="{{ $i }}" data-max-rating="5"></div>
                                    </a>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
