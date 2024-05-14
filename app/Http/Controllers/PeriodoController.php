<?php
namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\FechaPeriodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriodoController extends Controller
{
    /**
     * Muestra todas las fechas de periodo del usuario autenticado.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $calendarController = new CalendarController();
        $opcionAnimoRandom = $calendarController->obtenerOpcionAnimoUsuarioHoy();

        // Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // Obtener los eventos del usuario autenticado
        $eventos = Evento::where('user_id', $userId)->get();

        // Obtener las fechas de período del usuario autenticado
        $fechasPeriodo = FechaPeriodo::where('user_id', $userId)->get();

        return view('calendar', compact('eventos', 'fechasPeriodo', 'opcionAnimoRandom'));
    }

    /**
     * Guarda una nueva fecha de periodo en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'fechaPeriodo_inicio' => 'required|date',
            'fechaPeriodo_fin' => 'required|date',
        ]);

        // Crea una nueva instancia de FechaPeriodo con los datos del formulario
        $fechaPeriodo = new FechaPeriodo([
            'fechaPeriodo_inicio' => $request->fechaPeriodo_inicio,
            'fechaPeriodo_fin' => $request->fechaPeriodo_fin,
            'user_id' => Auth::id(),
        ]);

        // Guarda la fecha en la base de datos
        $fechaPeriodo->save();

        // Después de guardar, redirecciona al usuario a la vista 'calendar' utilizando el método 'index()'
        return $this->index();
    }
}

