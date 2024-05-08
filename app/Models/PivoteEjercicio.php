<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PivoteEjercicio extends Model
{
    protected $fillable = [
        'fecha', // Asegúrate de agregar este campo
        'user_id',
        'ejercicio_id',
        'fatiga',
        'molestias',
        'motivacion',
        'notas'
    ];

    // Resto del código del modelo...
}
