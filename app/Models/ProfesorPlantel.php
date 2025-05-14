<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesorPlantel extends Model
{
    protected $table = 'profesores_planteles';

    protected $fillable = [
        'profesor_id',
        'plantel_id',
        'periodo_id',
        'antiguedad',
        'turno',
        'fecha_asignacion',
    ];

    public function profesor(): BelongsTo
    {
        return $this->belongsTo(Profesor::class);
    }

    public function plantel(): BelongsTo
    {
        return $this->belongsTo(Plantel::class);
    }

}
