@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
                    <div class="card-header">{{ __('Registrar Síntoma') }}</div>
                        <form action="{{ route('storeSintomas') }}" method="POST">
                            @csrf
                            <label for="fecha">Fecha:</label>
                            <input type="date" id="fecha" name="fecha" value="{{ date('Y-m-d') }}" readonly required><br><br>

                            @foreach($tipo_sintomas as $tipo_sintoma)
                                <label>{{ $tipo_sintoma->tipo_sintoma }}:</label><br>
                                <select name="sintomas[{{ $tipo_sintoma->id }}][]" multiple>
                                    @foreach($opciones_por_tipo[$tipo_sintoma->tipo_sintoma] as $opcion)
                                        <option value="{{ $opcion }}">{{ $opcion }}</option>
                                    @endforeach
                                </select><br><br>
                            @endforeach


                            <label for="agua">Cantidad de Agua (en litros):</label>
                            <input type="number" step="0.01" id="agua" name="agua" required><br><br>

                            <label for="pasos">Número de Pasos:</label>
                            <input type="number" id="pasos" name="pasos"><br><br>

                            <label for="temperatura">Temperatura (en °C):</label>
                            <input type="number" step="0.01" id="temperatura" name="temperatura"><br><br>

                            <label for="peso">Peso (en kg):</label>
                            <input type="number" step="0.01" id="peso" name="peso"><br><br>

                            <label for="notas">Notas:</label><br>
                            <textarea id="notas" name="notas" rows="4" cols="50"></textarea><br><br>

                            <input type="submit" value="Enviar">
                        </form>
        </div>
    </div>
@endsection
