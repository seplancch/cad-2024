<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesorPlantel extends Model
{
    protected $table = 'profesor_plantel';

    protected $fillable = [
        'profesor_id',
        'plantel_id',
        'periodo_id',
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
