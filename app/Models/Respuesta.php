<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;


    protected $fillable = [
        'pregunta_id',
        'respuesta',
        'orden',
        'puntos',
    ];


    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }
}
