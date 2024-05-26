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
    public function index()
    {
        // Obtener el ID del usuario autenticado
        $userId = Auth::id();
        // Obtener la fecha actual
        $fechaActual = date('Y-m-d');
        // Obtener el mes actual
        $mesActual = date('m');

        $datosEjercicio = $this->obtenerDatosEjercicio($userId);
        $estadosAnimoMesActual = $this->obtenerOpcionesAnimoPorMes();
        $sintomasMesActual = $this->obtenerOpcionesSintomasPorMes();
        $datosDiarios = $this->obtenerDatosDiarios($userId);
        $pasosDiarios = $this->obtenerPDiarios($userId);
        $datosCiclo = $this->obtenerDuracionesPeriodo();
        $duracionCiclos = $this->obtenerDuracionCiclos();
        $duracionMediaCiclo = $this->calcularDuracionMediaCicloMenstrual();
        $duracionMediaPeriodo = $this->calcularDuracionMediaPeriodo();
        $mediaPasosSemanal = $this->mediaPasosSemanal($userId);
        $mediaAguaSemanal = $this->mediaAguaSemanal($userId);
        $mediaTemperaturaSemanal = $this->mediaTemperaturaSemanal($userId);

        return view('statistics', compact(
            'duracionCiclos',
            'datosCiclo',
            'duracionMediaCiclo',
            'duracionMediaPeriodo',
            'mediaPasosSemanal',
            'mediaAguaSemanal',
            'mediaTemperaturaSemanal',
            'estadosAnimoMesActual',
            'sintomasMesActual',
            'datosDiarios',
            'pasosDiarios',
            'datosEjercicio'
        ));
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

    public function obtenerDatosDiarios($userId)
    {
        $datosDiarios = PivoteSintoma::select(
            DB::raw('DATE(ANY_VALUE(created_at)) AS fecha'),
            DB::raw('MIN(agua) AS agua'),
            DB::raw('MIN(temperatura) AS temperatura')
        )
            ->where('user_id', $userId)
            ->groupBy('fecha')
            ->get();

        return $datosDiarios->toArray();
    }
    public function obtenerPDiarios($userId)
    {
        $datosDiarios = PivoteSintoma::select(
            DB::raw('DATE(ANY_VALUE(created_at)) AS fecha'),
            DB::raw('MIN(pasos) AS pasos'),
        )
            ->where('user_id', $userId)
            ->groupBy('fecha')
            ->get();

        return $datosDiarios->toArray();
    }
    public function mediaPasosSemanal($userId)
    {
        $fechaActual = Carbon::now();
        $inicioSemana = $fechaActual->startOfWeek()->format('Y-m-d');
        $finSemana = $fechaActual->endOfWeek()->format('Y-m-d');

        $mediaPasosSemanal = PivoteSintoma::where('user_id', $userId)
            ->whereBetween('fecha', [$inicioSemana, $finSemana])
            ->avg('pasos');

        return $mediaPasosSemanal;

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
        $mesActual = date('m');
        $opcionesAnimo = DB::table('sintomas')
            ->select('opcion_sintoma')
            ->where('tipo_sintoma', 'Ánimo')
            ->get()
            ->pluck('opcion_sintoma')
            ->toArray();
        $recuentoOpciones = [];
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
            $recuentoOpciones[] = [
                'opcion' => $opcion,
                'recuento' => $recuento
            ];
        }

        return $recuentoOpciones;
    }


    public function obtenerOpcionesSintomasPorMes()
    {
        $mesActual = date('m');
        $opcionesSintomas = DB::table('sintomas')
            ->select('opcion_sintoma')
            ->where('tipo_sintoma', 'Síntomas')
            ->get()
            ->pluck('opcion_sintoma')
            ->toArray();
        $recuentoOpciones = [];
        foreach ($opcionesSintomas as $opcion) {
            $recuento = DB::table('pivote_sintomas')
                ->where('opcion_sintoma_id', function ($query) use ($opcion) {
                    $query->select('id')
                        ->from('sintomas')
                        ->where('opcion_sintoma', $opcion)
                        ->where('tipo_sintoma', 'Síntomas');
                })
                ->whereMonth('fecha', '=', $mesActual)
                ->count();
            $recuentoOpciones[] = [
                'opcion' => $opcion,
                'recuento' => $recuento
            ];
        }

        return $recuentoOpciones;
    }
    public function obtenerDatosEjercicio($userId)
    {
        $mesActual = date('m');
        // Obtener los datos de fatiga, molestias y motivación para cada día del mes actual
        $estadisticasEjercicio = DB::table('pivote_ejercicios')
            ->select(DB::raw('DATE(created_at) as fecha'), DB::raw('MIN(fatiga) AS fatiga'), DB::raw('MIN(molestias) AS molestias'), DB::raw('MIN(motivacion) AS motivacion'))
            ->where('user_id', $userId)
            ->whereMonth('created_at', $mesActual)
            ->whereNotNull('fatiga')
            ->whereNotNull('molestias')
            ->whereNotNull('motivacion')
            ->groupBy(DB::raw('DATE(created_at)')) // Agrupar por fecha sin incluir la hora
            ->get()
            ->toArray();

        return $estadisticasEjercicio;
    }

}
