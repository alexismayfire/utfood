@if (Route::has('login'))
    <div class="ui large secondary menu">
        <div class="header item">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'UTFood') }}
            </a>
        </div>
        @auth
            <a class="item" style="" href="{{ route('estabelecimentos') }}">Estabelecimentos</a>
            <a class="item" href="{{ route('minhas_reservas') }}">Reservas</a>
            <a class="item" href="{{ route('favoritos') }}">Favoritos</a>
            <a class="browse item" style="" id="menu_conta">
                Conta
                <i class="dropdown icon"></i>
            </a>
            <div class="ui popup transition hidden">
                <div class="ui column relaxed divided grid">
                    <div class="column">
                        <div class="ui link list">
                            <a class="item" href="{{ route('editar_conta') }}">Editar Conta</a>
                            <a class="item" href="{{ route ('meus_estabelecimentos') }}">Meus Estabelecimentos</a>
                            <a class="item" href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
        @endauth
    </div>
@endif
