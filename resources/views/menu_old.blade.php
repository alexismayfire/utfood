@if (Route::has('login'))
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('estabelecimentos') }}">Estabelecimentos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('minhas_reservas') }}">Reservas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('favoritos') }}">Favoritos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route ('meus_estabelecimentos') }}">Meus Estabelecimentos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('conta') }}">Conta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registrar</a>
                        </li>
                    @endauth
                </ul>
            </div>

        </div>
    </nav>
@endif
