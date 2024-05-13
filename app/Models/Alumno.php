<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumnos';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inscripcion()
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function semestre()
    {
        return $this->hasMany(Semestre::class);
    }

    public function plantel()
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
