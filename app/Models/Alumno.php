<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumnos';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function inscripcion(): HasMany
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function semestre(): HasMany
    {
        return $this->hasMany(Semestre::class);
    }

    public function plantel(): HasMany
    {
        return $this->hasMany(Plantel::class, 'id', 'plantel_id');
    }

    public function getAlumnoId($id)
    {
        return $this->where('user_id', $id)->first();
    }

    public function getSemestre($id, $periodo)
    {
        return Semestre::where('alumno_id', $id)->where('periodo_id', $periodo)->first()->numero_semestre;
    }

}
