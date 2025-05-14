<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profesor extends Model
{
    use HasFactory;

    protected $table = 'profesores';

    protected $fillable = [
        'numero_trabajador',
        'rfc',
        'fecha_nacimiento',
        'sexo'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date:Y/m/d', // Define format for parsing
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function grupo(): HasMany
    {
        return $this->hasMany(Grupo::class);
    }

    public function plantel(): BelongsTo
    {
        return $this->belongsTo(Plantel::class);
    }

    public function profesorPlantel(): HasMany
    {
        return $this->hasMany(ProfesorPlantel::class);
    }
}
