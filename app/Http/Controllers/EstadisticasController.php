<?php

namespace App\Http\Controllers;

use App\Models\FechaPeriodo;
use App\Models\PivoteSintoma;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class EstadisticasController extends Controller
{
// Dentro de tu controlador...
    public function index()
    {
        // Obtener el ID del usuario autenticado
        $userId = Auth::id();
        // Obtener la fecha actual
        $fechaActual = date('Y-m-d');
        // Obtener el mes actual
        $mesActual = date('m');

        // Obtener los datos de pasos, agua y temperatura
        $pasosDiarios = $this->pasosDiarios($userId, $fechaActual);
        $cantidadAguaDiaria = $this->aguaDiaria($userId, $fechaActual);
        $temperaturaDiaria = $this->temperaturaDiaria($userId, $fechaActual);

        // Obtener los estados de ánimo por mes actual
        $estadosAnimoMesActual = $this->obtenerOpcionesAnimoPorMes();

        // Otras variables de estadísticas que ya tenías
        $datosCiclo = $this->obtenerDuracionesPeriodo();
        $duracionCiclos = $this->obtenerDuracionCiclos();
        $duracionMediaCiclo = $this->calcularDuracionMediaCicloMenstrual();
        $duracionMediaPeriodo = $this->calcularDuracionMediaPeriodo();
        $mediaPasosSemanal = $this->mediaPasosSemanal($userId);
        $mediaAguaSemanal = $this->mediaAguaSemanal($userId);
        $mediaTemperaturaSemanal = $this->mediaTemperaturaSemanal($userId);

        // Pasar todos los datos a la vista
        return view('statistics', compact(
            'duracionCiclos',
            'datosCiclo',
            'duracionMediaCiclo',
            'duracionMediaPeriodo',
            'pasosDiarios',
            'mediaPasosSemanal',
            'cantidadAguaDiaria',
            'mediaAguaSemanal',
            'temperaturaDiaria',
            'mediaTemperaturaSemanal',
            'estadosAnimoMesActual' // Agregando los estados de ánimo por mes actual
        ));

        dd(estadosAnimoMesActual);
    }

    public function obtenerDuracionesPeriodo()
    {
        // Obtener el ID del usuario autenticado
        $idUsuario = Auth::id();

        // Obtener los períodos asociados al usuario
        $periodosUsuario = FechaPeriodo::where('user_id', $idUsuario)->get();

        $duracionPeriodos = [];

        // Calcular la duración de cada período y agrupar por mes
        foreach ($periodosUsuario as $periodo) {
            $inicio = Carbon::parse($periodo->fechaPeriodo_inicio)->format('F');
            $fin = Carbon::parse($periodo->fechaPeriodo_fin);
            $duracion = Carbon::parse($periodo->fechaPeriodo_inicio)->diffInDays($fin); // Calcula la diferencia en días

            // Si el mes ya existe en el arreglo, sumar la duración, de lo contrario, agregarlo al arreglo
            if (isset($duracionPeriodos[$inicio])) {
                $duracionPeriodos[$inicio] += $duracion;
            } else {
                $duracionPeriodos[$inicio] = $duracion;
            }
        }

        // Formatear los datos para el gráfico
        $data = [];
        foreach ($duracionPeriodos as $mes => $duracion) {
            $data[] = [
                'Mes' => $mes,
                'duracion' => $duracion
            ];
        }

        return $data; // Devolver los datos sin formato JSON
    }

    public function obtenerDuracionCiclos()
    {
        // Obtener el ID del usuario autenticado
        $idUsuario = Auth::id();

        // Obtener todos los periodos ordenados por fecha de inicio para el usuario autenticado
        $periodos = FechaPeriodo::where('user_id', $idUsuario)
            ->orderBy('fechaPeriodo_inicio', 'asc')
            ->get();

        $duracionCiclos = [];

        // Calcular la diferencia de días entre el inicio de cada periodo y el inicio del siguiente
        $numPeriodos = count($periodos);
        for ($i = 0; $i < $numPeriodos - 1; $i++) {
            $inicioActual = Carbon::parse($periodos[$i]->fechaPeriodo_inicio);
            $inicioSiguiente = Carbon::parse($periodos[$i + 1]->fechaPeriodo_inicio);

            $mesInicioActual = $inicioActual->format('F');
            $mesInicioSiguiente = $inicioSiguiente->format('F');
            $diferenciaDias = $inicioActual->diffInDays($inicioSiguiente);

            // Guardar la duración del ciclo junto con los meses de inicio
            $duracionCiclos[] = [
                'mes_inicio_actual' => $mesInicioActual,
                'mes_inicio_siguiente' => $mesInicioSiguiente,
                'duracion' => $diferenciaDias
            ];
        }

        return $duracionCiclos; // Devolver las duraciones de los ciclos
    }
    public function calcularDuracionMediaCicloMenstrual()
    {
        // Obtener las duraciones de los ciclos
        $duracionCiclos = $this->obtenerDuracionCiclos();
        $numCiclos = count($duracionCiclos);

        // Si hay al menos un ciclo, calcular su duración media
        if ($numCiclos > 0) {
            // Inicializar la suma de las duraciones de los ciclos
            $sumaDuraciones = 0;

            // Sumar todas las duraciones de los ciclos
            foreach ($duracionCiclos as $ciclo) {
                $sumaDuraciones += $ciclo['duracion'];
            }

            // Calcular la duración media de los ciclos
            $duracionMediaCiclo = $sumaDuraciones / $numCiclos;
        } else {
            // Si no hay ciclos, establecer la duración media como 0
            $duracionMediaCiclo = 0;
        }

        return $duracionMediaCiclo;
    }


    public function calcularDuracionMediaPeriodo()
    {
        // Calcular la duración media de todos los periodos
        $duracionMedia = FechaPeriodo::avg(\DB::raw('DATEDIFF(fechaPeriodo_fin, fechaPeriodo_inicio)'));

        // Devolver la duración media
        return $duracionMedia;
    }

    public function pasosDiarios($userId, $fecha)
    {
        $pasosDiarios = PivoteSintoma::where('user_id', $userId)
            ->where('fecha', $fecha)
            ->get(['fecha', 'pasos']); // Seleccionar solo las columnas 'fecha' y 'pasos'

        return $pasosDiarios->toArray(); // Convertir la colección a un array
    }

    public function aguaDiaria($userId, $fecha)
    {
        $aguaDiaria = PivoteSintoma::where('user_id', $userId)
            ->where('fecha', $fecha)
            ->get(['fecha', 'agua']); // Seleccionar solo las columnas 'fecha' y 'agua'

        return $aguaDiaria->toArray(); // Convertir la colección a un array
    }

    public function temperaturaDiaria($userId, $fecha)
    {
        $temperaturaDiaria = PivoteSintoma::where('user_id', $userId)
            ->where('fecha', $fecha)
            ->get(['fecha', 'temperatura']); // Seleccionar solo las columnas 'fecha' y 'temperatura'

        return $temperaturaDiaria->toArray(); // Convertir la colección a un array
    }



    public function mediaPasosSemanal($userId)
    {
        $fechaActual = Carbon::now();
        $inicioSemana = $fechaActual->startOfWeek()->format('Y-m-d');
        $finSemana = $fechaActual->endOfWeek()->format('Y-m-d');

        $mediaPasosSemanal = PivoteSintoma::where('user_id', $userId)
            ->whereBetween('fecha', [$inicioSemana, $finSemana])
            ->avg('pasos');

        return  $mediaPasosSemanal;

    }

    public function mediaAguaSemanal($userId)
    {
        $fechaActual = Carbon::now();
        $inicioSemana = $fechaActual->startOfWeek()->format('Y-m-d');
        $finSemana = $fechaActual->endOfWeek()->format('Y-m-d');

        $mediaAguaSemanal = PivoteSintoma::where('user_id', $userId)
            ->whereBetween('fecha', [$inicioSemana, $finSemana])
            ->avg('agua');

        return $mediaAguaSemanal;
    }


    public function mediaTemperaturaSemanal($userId)
    {
        $fechaActual = Carbon::now();
        $inicioSemana = $fechaActual->startOfWeek()->format('Y-m-d');
        $finSemana = $fechaActual->endOfWeek()->format('Y-m-d');

        $mediaTemperaturaSemanal = PivoteSintoma::where('user_id', $userId)
            ->whereBetween('fecha', [$inicioSemana, $finSemana])
            ->avg('temperatura');

        return $mediaTemperaturaSemanal;
    }

    public function obtenerOpcionesAnimoPorMes()
    {
        // Obtener el mes actual del usuario
        $mesActual = date('m');

        // Obtener las opciones del tipo de síntoma "Ánimo"
        $opcionesAnimo = DB::table('sintomas')
            ->select('opcion_sintoma')
            ->where('tipo_sintoma', 'Ánimo')
            ->get()
            ->pluck('opcion_sintoma')
            ->toArray();

        // Inicializar el array para almacenar el recuento de cada opción
        $recuentoOpciones = [];

        // Calcular el recuento total de todos los síntomas de ánimo para el mes actual
        $recuentoTotal = DB::table('pivote_sintomas')
            ->whereIn('opcion_sintoma_id', function ($query) use ($opcionesAnimo) {
                $query->select('id')
                    ->from('sintomas')
                    ->whereIn('opcion_sintoma', $opcionesAnimo)
                    ->where('tipo_sintoma', 'Ánimo');
            })
            ->whereMonth('fecha', '=', $mesActual)
            ->count();

        // Recorrer cada opción y calcular su porcentaje con respecto al total
        foreach ($opcionesAnimo as $opcion) {
            $recuento = DB::table('pivote_sintomas')
                ->where('opcion_sintoma_id', function ($query) use ($opcion) {
                    $query->select('id')
                        ->from('sintomas')
                        ->where('opcion_sintoma', $opcion)
                        ->where('tipo_sintoma', 'Ánimo');
                })
                ->whereMonth('fecha', '=', $mesActual)
                ->count();

            // Calcular el porcentaje y manejar el caso cuando el recuento sea 0
            $porcentaje = $recuentoTotal != 0 ? ($recuento / $recuentoTotal) * 100 : 0;
            $recuentoOpciones[] = [
                'opcion' => $opcion,
                'porcentaje' => $porcentaje
            ];
            //dd($recuento, $recuentoTotal, $porcentaje);
        }

        return $recuentoOpciones;
    }



}
