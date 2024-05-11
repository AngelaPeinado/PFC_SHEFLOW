@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <br>
        <br>
        <br>
        <form action="{{ route('storeEjercicios') }}" method="POST">
            @csrf
            <hr>
            <label for="fecha" class="form-label fs-5">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="{{ date('Y-m-d') }}" readonly required
                   class="form-control mb-3">
            <hr>
            <div class="row">
                @foreach($tipo_ejercicios as $tipo_ejercicio)
                    <div class="col-md-3">
                        <div class="card-custom mb-4 "> <!-- Agregar la clase card-custom aquí -->
                            <div class="card-body-custom">
                                <label class="form-label fs-5">{{ $tipo_ejercicio->tipo_ejercicio }}:</label>
                                <div class="mb-3">
                                    @foreach($opciones_por_tipo[$tipo_ejercicio->tipo_ejercicio] as $opcion)
                                        <div class="checkbox-wrapper-41">
                                            <input class="check-input" type="checkbox"
                                                   name="ejercicios[{{ $tipo_ejercicio->id }}][]" value="{{ $opcion }}"
                                                   id="{{ $opcion }}">
                                            <label class="check-label" for="{{ $opcion }}">
                                                {{ $opcion }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
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
                            <label for="fatiga" class="form-label fs-5">Nivel de Fatiga:</label>
                            <div class="number-input">
                                <input type="number" id="fatiga" name="fatiga" min="0" max="10" value="0" required
                                       class="form-control mb-3">
                                <div class="buttons">
                                    <div class="increment">+</div>
                                    <div class="decrement">-</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-custom mb-4">
                        <div class="card-body">
                            <label for="molestias" class="form-label fs-5">Nivel de Molestias:</label>
                            <div class="number-input">
                                <input type="number" id="molestias" name="molestias" min="0" max="10" value="0"
                                       required
                                       class="form-control mb-3">
                                <div class="buttons">
                                    <div class="increment">+</div>
                                    <div class="decrement">-</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-custom mb-4">
                        <div class="card-body">
                            <label for="motivacion" class="form-label fs-5">Nivel de Motivación:</label>
                            <div class="number-input">
                                <input type="number" id="motivacion" name="motivacion" min="0" max="10"
                                       value="0" required
                                       class="form-control mb-3">
                                <div class="buttons">
                                    <div class="increment">+</div>
                                    <div class="decrement">-</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="full-width-container">
                <div class="card-body">
                    <label for="notas" class="form-label fs-5">Notas:</label>
                    <textarea placeholder="Escribe alguna nota" id="notas" name="notas" rows="4" style="overflow: hidden; word-wrap: break-word; resize: none; height: 160px; "></textarea>
                </div>
            </div>

            <hr>
            <input type="submit" value="Enviar" class="btn btn-primary btn-lg btn-block mt-4">
        </form>
    </div>
@endsection


