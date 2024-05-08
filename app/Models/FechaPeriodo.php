<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FechaPeriodo extends Model
{
    use HasFactory;

    protected $fillable = ['fechaPeriodo_inicio', 'fechaPeriodo_fin', 'user_id'];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
