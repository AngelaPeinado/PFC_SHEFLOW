<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function index()
    {
        return view('perfil');
    }

    public function uploadAvatar(Request $request)
    {
        // Valida la petición para asegurarte de que el campo perfil esté presente
        $request->validate([
            'perfil' => 'required|string',
        ]);

        // Obtén el usuario autenticado
        $user = auth()->user();

        // Actualiza el campo perfil del usuario con la ruta de la imagen seleccionada del carrusel
        $user->perfil = $request->perfil;
        $user->save();

        // Puedes redirigir a una página específica después de la actualización
        return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente');
    }

}
