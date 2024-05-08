<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuestionario extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'respuesta_p1',
        'respuesta_p2',
        'respuesta_p3',
        'respuesta_p4',
        'respuesta_p5',
        'respuesta_p6',
        'respuesta_p7',
        'respuesta_p8',
        'respuesta_p9',
        'respuesta_p10',
        'respuesta_p11',
    ];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
