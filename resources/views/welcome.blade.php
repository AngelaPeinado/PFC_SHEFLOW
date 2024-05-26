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

</div><footer class="bg-body-tertiary text-center">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
        <!-- Section: Social media -->
        <section class="mb-4">


            <!-- Google -->
            <a
                data-mdb-ripple-init
                class="btn text-white btn-floating m-1"
                style="background-color: #dd4b39;"
                href="#!"
                role="button"
            ><i class="fab fa-google"></i></a>

            <!-- Instagram -->
            <a
                data-mdb-ripple-init
                class="btn text-white btn-floating m-1"
                style="background-color: #ac2bac;"
                href="#!"
                role="button"
            ><i class="fab fa-instagram"></i></a>

            <!-- Github -->
            <a
                data-mdb-ripple-init
                class="btn text-white btn-floating m-1"
                style="background-color: #333333;"
                href="#!"
                role="button"
            ><i class="fab fa-github"></i></a>
        </section>
        <!-- Section: Social media -->
    </div>
    <hr>
    <div class="container p-4 pb-0">
        <!-- Section: Form -->
        <section class="">
            <form action="">
                <!--Grid row-->
                <div class="row d-flex justify-content-center">
                    <!--Grid column-->
                    <div class="col-auto">
                        <p class="pt-2">
                            <strong>Sign up for our newsletter</strong>
                        </p>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-5 col-12">
                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="email" id="form5Example26" class="form-control" />
                            <label class="form-label" for="form5Example26">Email address</label>
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-auto">
                        <!-- Submit button -->
                        <button data-mdb-ripple-init type="submit" class="btn btn-pink mb-4">
                            Subscribe
                        </button>
                    </div>
                    <!--Grid column-->
                </div>
                <!--Grid row-->
            </form>
        </section>
        <!-- Section: Form -->
    </div>
</footer>
</body>
</html>
