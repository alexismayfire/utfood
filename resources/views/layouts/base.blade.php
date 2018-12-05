<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/semantic.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/datepicker/default.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/datepicker/default.date.css') }}" rel="stylesheet" type="text/css">
        @yield('style')

        <!-- Scripts -->
        <script
            src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>
        <script src="{{ asset('js/semantic.min.js') }}"></script>
        <script src="{{ asset('js/legacy.js') }}"></script>
        <script src="{{ asset('js/picker.js') }}"></script>
        <script src="{{ asset('js/picker.date.js') }}"></script>
        <script src="{{ asset('js/vanilla.js') }}"></script>
        @yield('script')

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="app">
            @include('menu')
            @yield('modal')
            <div class="ui grid container">
                @yield('content')
            </div>
        </div>
    </body>
</html>
