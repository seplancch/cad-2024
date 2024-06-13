<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Respuesta extends Model
{
    use HasFactory;


    protected $fillable = [
        'pregunta_id',
        'respuesta',
        'orden',
        'puntos',
    ];


    public function pregunta(): BelongsTo
    {
        return $this->belongsTo(Pregunta::class);
    }
}
