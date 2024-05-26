<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SheFlow') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('SheFlow.png') }}" alt="Nombre de la app" style="width: 150px; height: auto;">
            </a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item" >
                    <div class="nav-link-wrapper">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Subscription') }}</a>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="nav-link-wrapper">
                        <a class="nav-link" href="{{ route('about_us') }}">{{ __('About us') }}</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-6 p-0 position-relative img-overlay">
                <a href="{{ route('register') }}">
                    <img src="{{ asset('WelcomeRegister.png') }}" alt="Log in" style="width: 100%; height: auto;">
                </a>
            </div>
            <div class="col-md-6 p-0 position-relative img-overlay">
                <a href="{{ route('login') }}">
                    <img src="{{ asset('WelcomeLogIn.png') }}" alt="Register" style="width: 100%; height: auto;">
                </a>
            </div>
        </div>
    </div>

</div>

</body>
</html>
