<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumno_id',
        'pregunta_id',
        'respuesta_id',
        'periodo_id',
    ];
}
