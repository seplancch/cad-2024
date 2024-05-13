<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantel extends Model
{
    use HasFactory;

    protected $table = 'planteles';

    protected $fillable = [
        'clave',
        'nombre',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'plantel_id', 'id');
    }
}
