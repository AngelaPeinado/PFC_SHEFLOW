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

        $userId = Auth::id();

        $eventos = Evento::where('user_id', $userId)->get();

        $fechasPeriodo = FechaPeriodo::where('user_id', $userId)->get();

        return view('calendar', compact('eventos', 'fechasPeriodo', 'opcionAnimoRandom'));
    }
    public function update(Request $request, $id)
    {
        $periodo = FechaPeriodo::findOrFail($id);

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $periodo->update([
            'fechaPeriodo_inicio' => $request->input('start_date'),
            'fechaPeriodo_fin' => $request->input('end_date'),
        ]);

        return response()->json(['success' => 'Período actualizado exitosamente.']);
    }

    /**
     * Guarda una nueva fecha de periodo en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fechaPeriodo_inicio' => 'required|date',
            'fechaPeriodo_fin' => 'required|date',
        ]);

        $fechaPeriodo = new FechaPeriodo([
            'fechaPeriodo_inicio' => $request->fechaPeriodo_inicio,
            'fechaPeriodo_fin' => $request->fechaPeriodo_fin,
            'user_id' => Auth::id(),
        ]);

        $fechaPeriodo->save();

        return redirect()->route('calendar.index')->with('success', 'Fecha de período guardada exitosamente.');
    }

    public function destroy($id)
    {
        $fechaPeriodo = FechaPeriodo::find($id);
        $fechaPeriodo->delete();
        return response()->json(['success' => true]);
    }

}

