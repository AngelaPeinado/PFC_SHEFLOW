<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use App\Models\PivoteEjercicio;
use App\Models\PivoteSintoma;
use App\Models\Sintoma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;


class RegistroDiarioController extends Controller
{
    public function registroDiarioHecho(){
        return view('RegistroDiarioHecho');
    }
    public function registroDiarioSintomas()
    {
        // Verificar si hay un registro en la fecha de hoy en la tabla pivoteSintomas
        $registroHoy = pivoteSintoma::whereDate('created_at', today())->exists();

        // Si hay un registro hoy, redirigir a otra pantalla
        if ($registroHoy) {
            return redirect()->route('RegistroDiarioHecho');
        }

        // Si no hay registro hoy, continuar con la lógica actual para mostrar la vista de registroDiarioSintomas

        // Obtener todos los tipos de síntomas
        $tipo_sintomas = Sintoma::select('tipo_sintoma')->distinct()->get();

        // Inicializar un array asociativo para almacenar las opciones de síntomas por tipo
        $opciones_por_tipo = [];

        // Obtener las opciones de síntomas para cada tipo de síntoma
        foreach ($tipo_sintomas as $tipo_sintoma) {
            $opciones_por_tipo[$tipo_sintoma->tipo_sintoma] = Sintoma::where('tipo_sintoma', $tipo_sintoma->tipo_sintoma)->distinct()->pluck('opcion_sintoma');
        }

        return view('registroDiarioSintomas', compact('tipo_sintomas', 'opciones_por_tipo'));
    }

    public function registroDiarioEjercicios()
    {
        // Verificar si hay un registro en la fecha de hoy en la tabla pivoteEjercicios
        $registroHoy = PivoteEjercicio::whereDate('created_at', today())->exists();

        // Si hay un registro hoy, redirigir a otra pantalla
        if ($registroHoy) {
            return redirect()->route('RegistroDiarioHecho');
        }

        // Si no hay registro hoy, continuar con la lógica actual para mostrar la vista de registroDiarioEjercicios

        // Obtener todos los tipos de ejercicios
        $tipo_ejercicios = Ejercicio::select('tipo_ejercicio')->distinct()->get();

        // Inicializar un array asociativo para almacenar las opciones de ejercicios por tipo
        $opciones_por_tipo = [];

        // Obtener las opciones de ejercicios para cada tipo de ejercicio
        foreach ($tipo_ejercicios as $tipo_ejercicio) {
            $opciones_por_tipo[$tipo_ejercicio->tipo_ejercicio] = Ejercicio::where('tipo_ejercicio', $tipo_ejercicio->tipo_ejercicio)->distinct()->pluck('opcion_ejercicio');

        }

        return view('registroDiarioEjercicio', compact('tipo_ejercicios', 'opciones_por_tipo'));
    }

    public function storeSintomas(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'agua' => 'required|numeric',
            // Agrega validaciones para los otros campos según tus necesidades
        ]);

        // Obtener el ID del usuario autenticado
        $user_id = Auth::id();

        // Obtener los datos del formulario
        $fecha = $request->input('fecha');
        $agua = $request->input('agua');
        $pasos = $request->input('pasos');
        $temperatura = $request->input('temperatura');
        $peso = $request->input('peso');
        $notas = $request->input('notas');

        // Iterar sobre los síntomas seleccionados y guardarlos en la tabla pivote
        foreach ($request->input('sintomas') as $tipo_sintoma_id => $sintomas) {
            foreach ($sintomas as $opcion_sintoma_nombre) {
                // Obtener el ID del síntoma
                $opcion_sintoma_id = Sintoma::where('opcion_sintoma', $opcion_sintoma_nombre)->value('id');

                // Verificar si se encontró el ID del síntoma
                if ($opcion_sintoma_id) {
                    // Crear un nuevo registro en la tabla PivoteSintoma
                    PivoteSintoma::create([
                        'fecha' => $fecha,
                        'user_id' => $user_id,
                        'opcion_sintoma_id' => $opcion_sintoma_id,
                        'agua' => $agua,
                        'pasos' => $pasos,
                        'temperatura' => $temperatura,
                        'peso' => $peso,
                        'notas' => $notas
                    ]);
                }
            }
        }


        return Redirect::route('inflex');
    }

    public function storeEjercicios(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'fatiga' => 'required|numeric|min:0|max:10',
            'molestias' => 'required|numeric|min:0|max:10',
            'motivacion' => 'required|numeric|min:0|max:10',
            // Agrega validaciones para los otros campos según tus necesidades
        ]);

        // Obtener el ID del usuario autenticado
        $user_id = Auth::id();

        // Obtener los datos del formulario
        $fecha = $request->input('fecha');
        $fatiga = $request->input('fatiga');
        $molestias = $request->input('molestias');
        $motivacion = $request->input('motivacion');
        $notas = $request->input('notas');

        // Iterar sobre los ejercicios seleccionados y guardarlos en la tabla pivote
        foreach ($request->input('ejercicios') as $tipo_ejercicio_id => $ejercicios) {
            foreach ($ejercicios as $opcion_ejercicio_nombre) {
                // Obtener el ID del ejercicio
                $opcion_ejercicio_id = Ejercicio::where('opcion_ejercicio', $opcion_ejercicio_nombre)->value('id');

                // Verificar si se encontró el ID del ejercicio
                if ($opcion_ejercicio_id) {
                    // Crear un nuevo registro en la tabla PivoteEjercicio
                    PivoteEjercicio::create([
                        'fecha' => $fecha,
                        'user_id' => $user_id,
                        'ejercicio_id' => $opcion_ejercicio_id,
                        'fatiga' => $fatiga,
                        'molestias' => $molestias,
                        'motivacion' => $motivacion,
                        'notas' => $notas
                    ]);
                }
            }
        }

        return redirect()->route('inflex');
    }


}
