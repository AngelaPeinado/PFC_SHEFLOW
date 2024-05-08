<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sintoma extends Model
{
    protected $table = 'sintomas';

    protected $fillable = [
        'tipo_sintoma',
        'opcion_sintoma',
    ];
}
