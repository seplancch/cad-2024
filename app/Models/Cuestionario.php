<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

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

    public function periodos(): HasMany
    {
        return $this->hasMany(Periodo::class);
    }

    public function estaEnUso(): bool
    {
        // Verificar si tiene períodos asociados
        if ($this->periodos()->exists()) {
            return true;
        }

        // Verificar si tiene preguntas con resultados
        return DB::table('resultados')
            ->join('preguntas', 'resultados.pregunta_id', '=', 'preguntas.id')
            ->where('preguntas.cuestionario_id', $this->id)
            ->exists();
    }
}
