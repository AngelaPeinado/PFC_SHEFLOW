<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoticiasController extends Controller
{
    public function filtrarNoticiasPorSintomas()
    {
        // Obtener las opciones de síntomas del usuario para el día de hoy
        $opcionesSintomasHoy = $this->obtenerOpcionesSintomasUsuarioHoy();
        // Realizar la búsqueda de noticias en la base de datos
        $noticiasFiltradas = Noticia::where(function ($query) use ($opcionesSintomasHoy) {
            foreach ($opcionesSintomasHoy as $sintoma) {
                $query->orWhere('nombre', 'like', "%{$sintoma}%");
            }
        })->get();
        // Obtener solo las imágenes de las noticias filtradas
        $imagenesNoticiasFiltradas = $noticiasFiltradas->pluck('imagen');
        // Retornamos las imágenes de las noticias filtradas
        return $imagenesNoticiasFiltradas;
    }

    public function obtenerOpcionesSintomasUsuarioHoy()
    {
        $userId = Auth::id();
        $fechaHoy = now()->toDateString();
        // Obtener las opciones de síntomas del usuario para el día de hoy
        $opcionesSintomasHoy = DB::table('pivote_sintomas')
            ->where('user_id', $userId)
            ->whereDate('fecha', $fechaHoy)
            ->select('opcion_sintoma_id')
            ->distinct()
            ->get()
            ->pluck('opcion_sintoma_id');
        // Obtener los nombres de las opciones de síntomas
        $nombresSintomasHoy = DB::table('sintomas')
            ->whereIn('id', $opcionesSintomasHoy)
            ->pluck('opcion_sintoma');
        return $nombresSintomasHoy;
    }

    public function filtrarNoticiasPorEjerciciosDeHoy()
    {
        // Obtener la fecha actual
        $hoy = Carbon::today();

        // Obtener los ejercicios registrados hoy desde la base de datos
        $ejerciciosHoy = DB::table('ejercicios')
            ->whereDate('created_at', $hoy)
            ->select('nombre_ejercicio')
            ->pluck('nombre_ejercicio')
            ->toArray();

        // Array de noticias (título e imagen)
        $noticias = [
            ['titulo' => 'La gripe aumenta en invierno', 'imagen' => 'gripe.jpg'],
            ['titulo' => 'Nueva vacuna contra el COVID-19', 'imagen' => 'vacuna.jpg'],
            ['titulo' => 'Alergias primaverales en aumento', 'imagen' => 'alergia.jpg'],
            ['titulo' => 'Consejos para evitar el resfriado', 'imagen' => 'resfriado.jpg'],
            ['titulo' => 'Causas y tratamiento del dolor de cabeza', 'imagen' => 'dolor_cabeza.jpg'],
            ['titulo' => 'Ejercicio para mejorar la respiración', 'imagen' => 'respiracion.jpg'],
            ['titulo' => 'Yoga para reducir el estrés', 'imagen' => 'yoga_estres.jpg'],
            ['titulo' => 'Cardio para aumentar la energía', 'imagen' => 'cardio.jpg'],
        ];

        // Array para las noticias filtradas
        $noticiasFiltradas = [];

        // Recorremos las noticias y los ejercicios para filtrar las noticias relevantes
        foreach ($noticias as $noticia) {
            foreach ($ejerciciosHoy as $ejercicio) {
                if (stripos($noticia['titulo'], $ejercicio) !== false) {
                    $noticiasFiltradas[] = $noticia;
                    break; // Salimos del bucle de ejercicios porque ya encontramos una coincidencia
                }
            }
        }

        // Retornamos las noticias filtradas como una respuesta JSON
        return response()->json($noticiasFiltradas);
    }
}

