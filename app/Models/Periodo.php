<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function cuestionario()
    {
        return $this->belongsTo(Cuestionario::class);
    }

    public function grupo()
    {
        return $this->hasMany(Grupo::class);
    }

    public function semestre()
    {
        return $this->hasMany(Semestre::class);
    }
}
