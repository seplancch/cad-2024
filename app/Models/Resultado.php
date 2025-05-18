<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resultado extends Model
{
    use HasFactory;

    protected $fillable = [
        'inscripcion_id',
        'pregunta_id',
        'respuesta_id',
    ];

    public function pregunta(): BelongsTo
    {
        return $this->belongsTo(Pregunta::class);
    }

    public function inscripcion(): BelongsTo
    {
        return $this->belongsTo(Inscripcion::class);
    }

    public function respuesta(): BelongsTo
    {
        return $this->belongsTo(Respuesta::class);
    }
}
