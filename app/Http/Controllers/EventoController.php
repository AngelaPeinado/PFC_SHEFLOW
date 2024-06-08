<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Evento;

class EventoController extends Controller
{
    public function index()
    {
        $events = Evento::where('user_id', Auth::id())->get();

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

    public function update(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);

        $request->validate([
            'Evento' => 'required|string',
            'Descripcion' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $evento->update([
            'Evento' => $request->input('Evento'),
            'Descripcion' => $request->input('Descripcion'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        return response()->json(['success' => 'Evento actualizado exitosamente.']);
    }


    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);
        $evento->delete();

        return response()->json(['success' => true]);
    }

}
