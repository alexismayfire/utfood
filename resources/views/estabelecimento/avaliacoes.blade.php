<div class="twelve wide column content text-left">
    <h3 class="ui header center aligned">{{ $avaliacao->usuario()->name }}</h3>
    <div class="description text-left">
        <div class="ui list relaxed">
            <div class="item">
                <div class="column content text-left">
                    @for($i = 1; $i <= 5; $i++)
                        @if($avaliacao->estrelas >= $i)
                            <i class="star icon"></i>
                        @else
                            <i class="star outline icon"></i>
                        @endif
                    @endfor
                    <p>{{ $avaliacao->comentario }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
