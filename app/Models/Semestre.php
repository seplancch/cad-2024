<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    use HasFactory;

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }
}
