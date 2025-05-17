<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripciones';


    protected $fillable = [
        'alumno_id',
        'grupo_id',
        'activa',
        'estado',
        'periodo_id',
        'autoinscripcion',
    ];


    public function alumno(): BelongsTo
    {
        return $this->belongsTo(Alumno::class);
    }

    public function grupo(): BelongsTo
    {
        return $this->belongsTo(Grupo::class);
    }

    public function resultados(): HasMany
    {
        return $this->hasMany(Resultado::class);
    }
}
