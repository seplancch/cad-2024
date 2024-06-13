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
        'cuestionario_id',
        'clave',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
    ];

    public function cuestionario(): BelongsTo
    {
        return $this->belongsTo(Cuestionario::class);
    }

    public function grupo(): HasMany
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
}
