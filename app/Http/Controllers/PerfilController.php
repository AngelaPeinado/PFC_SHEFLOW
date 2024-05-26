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
        try {
            $request->validate([
                'perfil' => 'required|string',
            ]);
            $user = auth()->user();
            $user->perfil = $request->perfil;
            $user->save();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

}
