<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Periodo extends Model
{
    use HasFactory;

    protected $fillable = [
        'clave',
        'descripcion',
        'cuestionario_id',
    ];

    public function cuestionario()
    {
        return $this->belongsTo(Cuestionario::class);
    }

    public function resultados()
    {
        return $this->hasMany(Resultado::class);
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }

    public function semestre(): HasMany
    {
        return $this->hasMany(Semestre::class);
    }

    public function periodo(): HasOne
    {
        return $this->hasOne(Configuracion::class);
    }

    public function estaEnUso()
    {
        // Verificar si tiene grupos con inscripciones que tienen resultados
        return $this->grupos()
            ->whereHas('inscripciones', function($query) {
                $query->whereHas('resultados');
            })
            ->exists();
    }
}
