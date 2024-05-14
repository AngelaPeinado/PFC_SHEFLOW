<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Evento;

class EventoController extends Controller
{
    public function index()
    {
        // Obtener eventos del usuario actual
        $events = Evento::where('user_id', Auth::id())->get();

        // Pasar los eventos a la vista del calendario
        return view('calendar.index', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Evento' => 'required|string',
            'Descripcion' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $evento = Evento::create([
            'user_id' => Auth::id(),
            'Evento' => $request->Evento,
            'Descripcion' => $request->Descripcion,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('calendar.index')->with('success', 'Evento agregado exitosamente.');
    }

    // Dentro de tu controlador EventoController.php

    public function update(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);

        $request->validate([
            'Evento' => 'required|string',
            'Descripcion' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $evento->update([
            'Evento' => $request->Evento,
            'Descripcion' => $request->Descripcion,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('calendar.index')->with('success', 'Evento actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);
        $evento->delete();

        return redirect()->route('calendar.index')->with('success', 'Evento eliminado exitosamente.');
    }

}
