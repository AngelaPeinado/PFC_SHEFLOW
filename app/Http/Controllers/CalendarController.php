<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\FechaPeriodo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function index()
    {
        // Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // Obtener los eventos del usuario autenticado
        $eventos = Evento::where('user_id', $userId)->get();

        // Obtener las fechas de período del usuario autenticado
        $fechasPeriodo = FechaPeriodo::where('user_id', $userId)->get();

        // Obtener la opción de ánimo seleccionada aleatoriamente
        $opcionAnimoRandom = $this->obtenerOpcionAnimoUsuarioHoy();

        return view('calendar', compact('eventos', 'fechasPeriodo', 'opcionAnimoRandom'));

    }
    public function obtenerOpcionesAnimoConFoto()
    {
        $fotosYFrases = [
            'feliz' => ['foto' => 'SheFlowWomenHappy.png', 'frase' => '¡Hoy es un buen día!'],
            'triste' => ['foto' => 'SheFlowWomenSad.png', 'frase' => 'Has registrado triste como estado de ánimo...¡Te aseguro que mañana será un día mejor! '],
            'ansiosa' => ['foto' => 'SheFlowWomenStressed.png', 'frase' => 'Respira profundo y relájate.'],
            'cansada' => ['foto' => 'SheFlowWomanEatGood.png', 'frase' => '¿Estás cansada? ¡Descansa y no te olvides de comer bien!'],
            'vacia' => ['foto' => 'SheFlowWomenNotAlone.png', 'frase' => 'Si te sientes vacía...habla con tu mejor amiga/o y te sentirás mucho mejor'],
            'preocupada' => ['foto' => 'SheFlowWomanMeditate.png', 'frase' => 'Respira y medita. ¿Por qué estas preocupada? ¿Cómo lo puedo solucionar o mejorar?'],
            'activa' => ['foto' => 'SheFlowWomanSportGood.png', 'frase' => '¡Hoy es un buen día para hacer deporte!'],
            'confundida' => ['foto' => 'SheFlowWomenShopping.png', 'frase' => '¿Estás confundida? ¡Haz planes con tus amigas/os!'],
            'apatica' => ['foto' => 'SheFlowWomenNeedToRest.png', 'frase' => 'Darse un respiro también es importante'],
            'calmada' => ['foto' => 'SheFlowWomenCalmada.png', 'frase' => '¡Disfruta de tu día!'],
            'frustrada' => ['foto' => 'SheFlowWomenFrustrada.png', 'frase' => 'Si estas frustrada...¡Distraete con tus hobbies!'],
            'enfadada' => ['foto' => 'SheFlowWomenAngry.png', 'frase' => '¿Estás enfadada? ¡Grita! !Desahógate! '],
            // Agrega más opciones según necesites
        ];

        // Obtener todas las opciones de síntomas de tipo "Ánimo"
        $opcionesAnimo = DB::table('sintomas')
            ->select('opcion_sintoma')
            ->where('tipo_sintoma', 'Ánimo')
            ->pluck('opcion_sintoma')
            ->toArray();

        // Asociar cada opción de ánimo con su foto y frase correspondiente
        $opcionesAnimoConFotoYFrase = [];
        foreach ($opcionesAnimo as $opcion) {
            if (array_key_exists($opcion, $fotosYFrases)) {
                $opcionesAnimoConFotoYFrase[] = [
                    'opcion' => $opcion,
                    'foto' => $fotosYFrases[$opcion]['foto'],
                    'frase' => $fotosYFrases[$opcion]['frase']
                ];
            }
        }

        return $opcionesAnimoConFotoYFrase;
    }
    public function obtenerOpcionAnimoUsuarioHoy()
    {
        // Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // Obtener la fecha actual
        $fechaActual = date('Y-m-d');

        // Consultar la tabla donde se registran las elecciones del usuario para el día de hoy
        $opcionesUsuarioHoy = DB::table('pivote_sintomas')
            ->join('sintomas', 'pivote_sintomas.opcion_sintoma_id', '=', 'sintomas.id')
            ->select('sintomas.opcion_sintoma')
            ->where('pivote_sintomas.user_id', $userId)
            ->whereDate('pivote_sintomas.created_at', $fechaActual)
            ->where('sintomas.tipo_sintoma', 'Ánimo')
            ->pluck('sintomas.opcion_sintoma')
            ->toArray();

        // Verificar si el usuario ha hecho alguna elección de ánimo hoy
        if (!empty($opcionesUsuarioHoy)) {
            // Obtener las opciones de ánimo con foto y frase
            $opcionesAnimoConFoto = $this->obtenerOpcionesAnimoConFoto();

            // Filtrar las opciones de ánimo con foto y frase según las elecciones del usuario hoy
            $opcionesDisponibles = array_filter($opcionesAnimoConFoto, function ($opcion) use ($opcionesUsuarioHoy) {
                return in_array($opcion['opcion'], $opcionesUsuarioHoy);
            });

            // Seleccionar una opción aleatoria de las opciones disponibles
            return !empty($opcionesDisponibles) ? $opcionesDisponibles[array_rand($opcionesDisponibles)] : null;
        } else {
            // El usuario no ha hecho ninguna elección de ánimo hoy
            return null;
        }
    }

}
