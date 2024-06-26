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

        // Instanciar el controlador de noticias
        $noticiasController = new NoticiasController();

        // Obtener solo las imágenes de las noticias filtradas por síntomas
        $imagenesNoticiasFiltradas = $noticiasController->filtrarNoticiasPorSintomas();

        // Obtener la opción de ánimo seleccionada aleatoriamente
        $opcionAnimoRandom = $this->obtenerOpcionAnimoUsuarioHoy();

        return view('calendar', compact('eventos', 'fechasPeriodo', 'opcionAnimoRandom', 'imagenesNoticiasFiltradas'));
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
        ];
        $opcionesAnimo = DB::table('sintomas')
            ->select('opcion_sintoma')
            ->where('tipo_sintoma', 'Ánimo')
            ->pluck('opcion_sintoma')
            ->toArray();

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
        $userId = Auth::id();
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
            $opcionesAnimoConFoto = $this->obtenerOpcionesAnimoConFoto();
            $opcionesDisponibles = array_filter($opcionesAnimoConFoto, function ($opcion) use ($opcionesUsuarioHoy) {
                return in_array($opcion['opcion'], $opcionesUsuarioHoy);
            });
            return !empty($opcionesDisponibles) ? $opcionesDisponibles[array_rand($opcionesDisponibles)] : null;
        } else {
            return null;
        }
    }

}
