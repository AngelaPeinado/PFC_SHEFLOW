<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PivoteSintoma extends Model
{
    protected $table = 'pivote_sintomas';

    protected $fillable = [
        'fecha',
        'user_id',
        'opcion_sintoma_id',
        'agua',
        'pasos',
        'temperatura',
        'peso',
        'notas',
    ];
}
