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
        'cuestionario_id',
    ];

    public function rubro()
    {
        return $this->belongsTo(Rubro::class);
    }

    public function cuestionario()
    {
        return $this->belongsTo(Cuestionario::class);
    }
}
