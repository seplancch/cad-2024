<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plantel extends Model
{
    use HasFactory;

    protected $table = 'planteles';

    protected $fillable = [
        'clave',
        'nombre',
    ];

    public function alumno(): BelongsTo
    {
        return $this->belongsTo(Alumno::class, 'plantel_id', 'id');
    }

    public function grupo(): HasMany
    {
        return $this->hasMany(Grupo::class);
    }

    public function profesorPlantel(): hasMany
    {
        return $this->hasMany(ProfesorPlantel::class);
    }

    public static function getIdPlantel($clave)
    {
        return Plantel::where('clave', $clave)->first()->id;
    }
}
