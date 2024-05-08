<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\FechaPeriodo;

class CalendarController extends Controller
{
    public function index()
    {
        // Obtener el ID del usuario autenticado
        $userId = auth()->id();

        // Obtener los eventos del usuario autenticado
        $eventos = Evento::where('user_id', $userId)->get();

        // Obtener las fechas de período del usuario autenticado
        $fechasPeriodo = FechaPeriodo::where('user_id', $userId)->get();

        return view('calendar', compact('eventos', 'fechasPeriodo'));
    }
}


