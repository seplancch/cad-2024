<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;


    public function grupo()
    {
        return $this->hasMany(Grupo::class);
    }

    public static function getIdAsignatura($clave)
    {
        return Asignatura::where('clave', $clave)->first()->id;
    }
}
