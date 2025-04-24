<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'seccion',
        'asignatura_id',
        'profesor_id',
        'plantel_id',
        'periodo_id',
    ];

    public function inscripcion(): HasMany
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function profesor(): BelongsTo
    {
        return $this->belongsTo(Profesor::class);
    }

    public function asignatura(): BelongsTo
    {
        return $this->belongsTo(Asignatura::class);
    }

    public function plantel(): BelongsTo
    {
        return $this->belongsTo(Plantel::class);
    }

    public function periodo(): BelongsTo
    {
        return $this->belongsTo(Periodo::class);
    }


    public function getGrupoId($nombre, $seccion, $asignatura, $plantel): int
    {
        return Grupo::where('nombre', $nombre)
            ->where('seccion', $seccion)
            ->where('asignatura_id', $asignatura)
            ->where('plantel_id', $plantel)
            ->first()
            ->id;
    }
}

