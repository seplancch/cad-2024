<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function inscripcion()
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }

    public function plantel()
    {
        return $this->belongsTo(Plantel::class);
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

}

