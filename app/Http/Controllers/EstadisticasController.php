<?php

namespace App\Http\Controllers;

use App\Models\FechaPeriodo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EstadisticasController extends Controller
{
    public function index()
    {
        $datosCiclo= $this->obtenerDuracionesPeriodo();
        $duracionCiclos=$this->obtenerDuracionCiclos();
        $duracionMediaCiclo = $this->calcularDuracionMediaCicloMenstrual();
        $duracionMediaPeriodo = $this->calcularDuracionMediaPeriodo();

        return view('statistics', compact('duracionCiclos','datosCiclo', 'duracionMediaCiclo', 'duracionMediaPeriodo'));

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

}
