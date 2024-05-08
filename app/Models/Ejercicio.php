<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    protected $table = 'ejercicios';

    protected $fillable = [
        'tipo_ejercicio',
        'opcion_ejercicio',
    ];
}
