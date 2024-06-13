<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rubro extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion'
    ];

    public function preguntas(): HasMany
    {
        return $this->hasMany(Pregunta::class);
    }
}
