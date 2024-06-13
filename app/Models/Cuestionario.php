<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cuestionario extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'version'
    ];

    public function preguntas(): HasMany
    {
        return $this->hasMany(Pregunta::class);
    }
}
