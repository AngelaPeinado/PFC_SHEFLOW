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
            <div class="row">
                @foreach($tipo_sintomas as $tipo_sintoma)
                    <div class="col-md-3">
                        <div class="card-custom mb-4 "> <!-- Agregar la clase card-custom aquí -->
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

            <div class="row">
                <div class="col-md-3">
                    <div class="card-custom mb-4">
                        <div class="card-body">
                            <label for="fecha" class="form-label fs-5">Fecha:</label>
                            <input type="date" id="fecha" name="fecha" value="{{ date('Y-m-d') }}" readonly required
                                   class="form-control">
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-custom mb-4">
                        <div class="card-body">
                            <label for="agua" class="form-label fs-5">Cantidad de Agua (en litros):</label>
                            <input type="number" step="0.01" id="agua" name="agua" required class="form-control">
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-custom mb-4">
                        <div class="card-body">
                            <label for="pasos" class="form-label fs-5">Número de Pasos:</label>
                            <input type="number" id="pasos" name="pasos" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-custom mb-4">
                        <div class="card-body">
                            <label for="temperatura" class="form-label fs-5">Temperatura (en °C):</label>
                            <input type="number" step="0.01" id="temperatura" name="temperatura" class="form-control">
                        </div>
                    </div>
                </div>
            </div>



            <div class="full-width-container">
                <div class="card-body">
                    <label for="notas" class="form-label fs-5">Notas:</label>
                    <textarea placeholder="Escribe alguna nota" id="notas" name="notas" rows="4" style="overflow: hidden; word-wrap: break-word; resize: none; height: 160px; "></textarea>

                </div>
            </div>


            <input type="submit" value="Enviar" class="btn btn-primary btn-lg btn-block mt-4">
        </form>
    </div>
@endsection
