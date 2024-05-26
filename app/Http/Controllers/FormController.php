<?php

namespace App\Http\Controllers;

use App\Models\Cuestionario;
use App\Models\Evento;
use App\Models\FechaPeriodo;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * Muestra el formulario inicial.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index() {
        $userId = auth()->user()->id;

        // Verificar si existe un formulario asociado al usuario
        $formularioExistente = Cuestionario::where('user_id', $userId)->exists();

        $calendarController = new CalendarController();

        $opcionAnimoRandom = $calendarController->obtenerOpcionAnimoUsuarioHoy();
        $noticiasController = new NoticiasController();
        $imagenesNoticiasFiltradas = $noticiasController->filtrarNoticiasPorSintomas();

        // Redirigir al usuario según el formulario existente
        if ($formularioExistente) {
            $userId = auth()->id();
            $eventos = Evento::where('user_id', $userId)->get();
            $fechasPeriodo = FechaPeriodo::where('user_id', $userId)->get();
            return view('calendar', compact('eventos', 'fechasPeriodo', 'opcionAnimoRandom','imagenesNoticiasFiltradas'));
        } else {
            return view('form'); // Redirigir a la página 'form'
        }
    }
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            // Aquí puedes agregar reglas de validación si es necesario
        ]);

        // Guardar las respuestas en la base de datos
        $cuestionario = new Cuestionario();
        $cuestionario->user_id = auth()->user()->id; // Suponiendo que hay un usuario autenticado
        // Asignar respuestas del formulario a las columnas correspondientes en la tabla
        $cuestionario->respuesta_p1 = $request->input('respuesta_p1');
        $cuestionario->respuesta_p2 = $request->input('respuesta_p2');
        $cuestionario->respuesta_p3 = $request->input('respuesta_p3');
        $cuestionario->respuesta_p4 = $request->input('respuesta_p4');
        $cuestionario->respuesta_p5 = $request->input('respuesta_p5');
        $cuestionario->respuesta_p6 = $request->input('respuesta_p6');
        $cuestionario->respuesta_p7 = $request->input('respuesta_p7');
        $cuestionario->respuesta_p8 = $request->input('respuesta_p8');
        $cuestionario->respuesta_p9 = $request->input('respuesta_p9');
        $cuestionario->respuesta_p10 = $request->input('respuesta_p10');
        $cuestionario->respuesta_p11 = $request->input('respuesta_p11');
        $cuestionario->save();

        // Establecer el estado del cuestionario como completado para el usuario actual
        auth()->user()->update(['cuestionario_completado' => true]);

        // Redirigir al usuario al calendario correspondiente
        return redirect()->route('calendar.index');
    }
}
