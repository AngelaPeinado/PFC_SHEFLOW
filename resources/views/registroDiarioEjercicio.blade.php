@extends('layouts.app')

@section('content')
    @extends('layouts.app')

    @section('content')
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="card-header">{{ __('Registrar Ejercicio') }}</div>
                <form action="{{ route('storeEjercicios') }}" method="POST">
                    @csrf
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" value="{{ date('Y-m-d') }}" readonly required><br><br>

                    @foreach($tipo_ejercicios as $tipo_ejercicio)
                        <label>{{ $tipo_ejercicio->tipo_ejercicio }}:</label><br>
                        <select name="ejercicios[{{ $tipo_ejercicio->id }}][]" multiple>
                            @foreach($opciones_por_tipo[$tipo_ejercicio->tipo_ejercicio] as $opcion)
                                <option value="{{ $opcion }}">{{ $opcion }}</option>
                            @endforeach
                        </select><br><br>
                    @endforeach

                    <label for="fatiga">Nivel de Fatiga:</label>
                    <input type="number" id="fatiga" name="fatiga" min="0" max="10" required><br><br>

                    <label for="molestias">Nivel de Molestias:</label>
                    <input type="number" id="molestias" name="molestias" min="0" max="10" required><br><br>

                    <label for="motivacion">Nivel de Motivación:</label>
                    <input type="number" id="motivacion" name="motivacion" min="0" max="10" required><br><br>

                    <label for="notas">Notas:</label><br>
                    <textarea id="notas" name="notas" rows="4" cols="50"></textarea><br><br>

                    <input type="submit" value="Enviar">
                </form>
            </div>
        </div>
    @endsection


@endsection
