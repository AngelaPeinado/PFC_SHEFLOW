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
    @vite(['resources/sass/calendar.scss', 'resources/js/app.js'])
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: "es",
                themeSystem: 'bootstrap',
                headerToolbar: {
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay',
                    left: 'today,prev,next'
                },
                views: {
                    dayGridMonth: {
                        titleFormat: { month: 'long', year: 'numeric' },
                        dayHeaderFormat: { weekday: 'long'},
                        dayMaxEventRows: 3
                    },
                    timeGridWeek: {
                        slotDuration: '00:30:00',
                        slotLabelFormat: { hour: 'numeric', minute: '2-digit', omitZeroMinute: false, meridiem: 'short' },
                        columnHeaderFormat: { weekday: 'short' },
                        dayMaxEventRows: 6
                    },
                    timeGridDay: {
                        slotDuration: '00:15:00',
                        slotLabelFormat: { hour: 'numeric', minute: '2-digit', omitZeroMinute: false, meridiem: 'short' },
                        columnHeaderFormat: { weekday: 'long', month: 'numeric', day: 'numeric' },
                        dayMaxEventRows: 10
                    },
                },
                events: [
                        @if($eventos->isNotEmpty())
                        @foreach($eventos as $evento)
                    {
                        Evento: '{{ $evento->Evento }}',
                        start: '{{ $evento->start_date }}',
                        end: '{{ $evento->end_date }}',
                        color: '#e52d3d', // Color del evento
                        description: '{{ $evento->Descripcion }}'
                    },
                        @endforeach
                        @endif
                        @foreach($fechasPeriodo as $fechaPeriodo)
                    {
                        title: 'Período',
                        start: '{{ $fechaPeriodo->fechaPeriodo_inicio }}',
                        end: '{{ $fechaPeriodo->fechaPeriodo_fin }}',
                        color: '#9a001b', // Color del período
                        description: 'Período'
                    },
                    @endforeach
                ],
                eventBackgroundColor: '#A0404B',
                eventDisplay: 'block',
                dayMaxEventRows: true,
                dayPopoverFormat: { month: 'short', day: 'numeric', weekday: 'long' },
                dateClick: function(info) {
                    $('#menuModal').modal('show');
                },
            });
            calendar.render();
        });
    </script>
</head>
<body>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="SheFlowCalendar1.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="SheFlowPrediccion.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="SheFlowRendimiento.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="SheFlowCuidarse.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="SheFlowfuncion.png" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div id="app">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('SheFlow.png') }}" alt="Nombre de tu aplicación" style="width: 150px; height: auto;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-lg-end" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="nav-link-wrapper">
                            <a class="nav-link" href="{{ route('inflex') }}">Registro diario</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link-wrapper">
                            <a class="nav-link" href="{{ route('estadisticas') }}">Mis estadísticas</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link-wrapper">
                            <a class="nav-link" href="{{ route('perfil') }}">Mi perfil</a>
                        </div>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <div class="nav-link-wrapper">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </div>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <div class="nav-link-wrapper">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </div>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <div class="nav-link-wrapper">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div id='calendar'></div>
    <!----------------------MODALES-------------------------->
    <div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEventModal">
                        <strong>AGREGAR EVENTO</strong>
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPeriodModal">
                        <strong>REGISTRAR PERIODO</strong>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PARA AGREGAR EVENTO -->
    <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-event">
                <div class="modal-header">
                    <h4 class="modal-title modal-title-event" id="addEventModalLabel">Agregar Evento</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('events.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="Evento" class="form-label form-label-event">Evento</label>
                            <input type="text" class="form-control form-control-event" id="Evento" name="Evento" required>
                        </div>
                        <div class="mb-3">
                            <label for="Descripcion" class="form-label form-label-event">Descripción</label>
                            <textarea class="form-control form-control-event" id="Descripcion" name="Descripcion" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label form-label-event">Fecha de Inicio</label>
                            <input type="datetime-local" class="form-control form-control-event" id="start_date" name="start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label form-label-event">Fecha de Fin</label>
                            <input type="datetime-local" class="form-control form-control-event" id="end_date" name="end_date" required>
                        </div>
                        <button type="submit" class="btn btn-save-event">Guardar Evento</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PARA AGREGAR PERÍODO -->
    <div class="modal fade" id="addPeriodModal" tabindex="-1" aria-labelledby="addPeriodModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-content-period">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPeriodModalLabel">Agregar Período</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('period.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="fechaPeriodo_inicio" class="form-label form-label-event">Fecha de Inicio</label>
                            <input type="date" class="form-control form-control-event" id="fechaPeriodo_inicio" name="fechaPeriodo_inicio" required>
                        </div>
                        <div class="mb-3">
                            <label for="fechaPeriodo_fin" class="form-label form-label-event">Fecha de Fin</label>
                            <input type="date" class="form-control form-control-event" id="fechaPeriodo_fin" name="fechaPeriodo_fin" required>
                        </div>
                        <button type="submit" class="btn btn-save-event">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!------------------------------------------------------------->
    <hr class="linea" style="margin: 20px 0;">
    <h2 class="articulos-recientes">Artículos más recientes</h2>
    <hr class="linea" style="margin-bottom: 20px;">

    <div id="carouselNews" class="carousel News" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row">
                    <div class="col-md-4">
                        <a href="url_de_tu_pagina1">
                            <img src="HABITOS.png" class="d-block w-100" alt="...">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="url_de_tu_pagina1">
                        <img src="ANTICONCEPTIVOS.png" class="d-block w-100" alt="...">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="url_de_tu_pagina1">
                        <img src="LIBROS.png" class="d-block w-100" alt="...">
                        </a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row">
                    <div class="col-md-4">
                        <a href="url_de_tu_pagina1">
                        <img src="CICLOREDIMIENTO.png" class="d-block w-100" alt="...">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="url_de_tu_pagina1">
                        <img src="EJERCICIOMENSTRUACION.png" class="d-block w-100" alt="...">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="url_de_tu_pagina1">
                        <img src="SUELOPELVICO.png" class="d-block w-100" alt="...">
                        </a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row">
                    <div class="col-md-4">
                        <a href="url_de_tu_pagina1">
                        <img src="AMENORREA.png" class="d-block w-100" alt="...">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="url_de_tu_pagina1">
                        <img src="DESEQUILIBRIO.png" class="d-block w-100" alt="...">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="url_de_tu_pagina1">
                        <img src="PISCINA.png" class="d-block w-100" alt="...">
                        </a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row">
                    <div class="col-md-4">
                        <a href="url_de_tu_pagina1">
                        <img src="ESTRES.png" class="d-block w-100" alt="...">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="url_de_tu_pagina1">
                        <img src="COPA .png" class="d-block w-100" alt="...">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="url_de_tu_pagina1">
                        <img src="FREEB.png" class="d-block w-100" alt="...">
                        </a>
                    </div>
                </div>
            </div>
            <!-- Aquí puedes agregar más elementos carousel-item según sea necesario -->
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselNews" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselNews" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <hr class="linea" style="margin-bottom: 20px;">

</div>

</body>
</html>
