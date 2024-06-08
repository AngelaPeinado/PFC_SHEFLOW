@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <br>
        <br>
        <br>
        <br>
        <br>
        <form action="{{ route('storeSintomas') }}" method="POST">
            @csrf
            <div class="container-label">
                <label for="fecha" class="form-label fs-5 hidden-label">Fecha:</label>
                <div class="date-input-container">
                    <input type="date" id="fecha" name="fecha" value="{{ date('Y-m-d') }}" readonly required
                           class="form-control">
                    <span class="date-icon"></span>
                </div>
                <hr>
            </div>
            <br>
            <br>
            <hr>
            <div class="row">
                @foreach($tipo_sintomas as $tipo_sintoma)
                    <div class="col-md-3">
                        <div class="card-custom mb-4">
                            <div class="card-body-custom">
                                <label class="form-label fs-5">{{ $tipo_sintoma->tipo_sintoma }}:</label>
                                @foreach($opciones_por_tipo[$tipo_sintoma->tipo_sintoma] as $opcion)
                                    <div class="checkbox-wrapper-41">
                                        <input class="check-input" type="checkbox"
                                               name="sintomas[{{ $tipo_sintoma->id }}][]" value="{{ $opcion }}"
                                               id="{{ $opcion }}">
                                        <label class="check-label" for="{{ $opcion }}">
                                            {{ $opcion }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <div class="card-custom mb-4">
                        <div class="card-body">
                            <label for="agua" class="form-label fs-5">Cantidad de Agua (en litros):</label>
                            <div class="number-input">
                                <input type="number" id="agua" name="agua" min="0" max="10" step="0.1" value="0" required
                                       class="form-control mb-3">
                                <div class="buttons">
                                    <div class="increment-agua">+</div>
                                    <div class="decrement-agua">-</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-custom mb-4">
                        <div class="card-body">
                            <label for="pasos" class="form-label fs-5">Número de Pasos:</label>
                            <div class="number-input">
                                <input type="number" id="pasos" name="pasos" min="0" max="1000000" value="0" required
                                       class="form-control mb-3">
                                <div class="buttons">
                                    <div class="increment-pasos">+</div>
                                    <div class="decrement-pasos">-</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-custom mb-4">
                        <div class="card-body">
                            <label for="temperatura" class="form-label fs-5">Temperatura (en °C):</label>
                            <div class="number-input">
                                <input type="number" id="temperatura" name="temperatura" min="30" max="45" step="0.1"
                                       value="36" required class="form-control mb-3">
                                <div class="buttons">
                                    <div class="increment-temperatura">+</div>
                                    <div class="decrement-temperatura">-</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="full-width-container">
                    <div class="card-body">
                        <label for="notas" class="form-label fs-5">Notas:</label>
                        <textarea placeholder="Escribe alguna nota" id="notas" name="notas" rows="4"
                                  style="overflow: hidden; word-wrap: break-word; resize: none; height: 160px;"></textarea>
                    </div>
                </div>
            </div>
            <hr>
            <button type="submit" class="cta" id="guardarBtn">
                <span>{{ __('Enviar') }}</span>
                <svg width="13px" height="10px" viewBox="0 0 13 10">
                    <path d="M1,5 L11,5"></path>
                    <polyline points="8 1 12 5 8 9"></polyline>
                </svg>
            </button>
        </form>
    </div>
@endsection
