<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script>
        console.log("__________                    .___ ________                .__               \n" +
            "\\______   \\ _____   ____    __| _/ \\______ \\   ____   _____|__| ____   ____  \n" +
            " |       _//     \\ /    \\  / __ |   |    |  \\_/ __ \\ /  ___/  |/ ___\\ /    \\ \n" +
            " |    |   \\  Y Y  \\   |  \\/ /_/ |   |    `   \\  ___/ \\___ \\|  / /_/  >   |  \\\n" +
            " |____|_  /__|_|  /___|  /\\____ |  /_______  /\\___  >____  >__\\___  /|___|  /\n" +
            "        \\/      \\/     \\/      \\/          \\/     \\/     \\/  /_____/      \\/");
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/_ds.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">
    @include('partials.dashboard.nav')
    <div id="wrapper">
        @include('partials.dashboard.sidenav')
        <div id="content-wrapper">
            <div class="container-fluid" id="content">
                @yield('content')
            </div>
        </div>
        {{--        @include('partials.footer.footer')--}}
    </div>
</div>
@yield('scripts')
</body>
</html>
