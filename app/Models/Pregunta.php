<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'opcion_1',
        'opcion_2',
        'opcion_3',
        'opcion_4',
        'opcion_5',
        'correct_answer_no',
        'rubro_id',
        'encuesta_id',
    ];

    public function rubro()
    {
        return $this->belongsTo(Rubro::class);
    }

    public function encuesta()
    {
        return $this->belongsTo(Encuesta::class);
    }
}
