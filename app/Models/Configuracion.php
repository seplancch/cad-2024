<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Configuracion extends Model
{
    use HasFactory;

    protected $table = 'configuraciones';

    protected $fillable = [
        'nombre',
        'valor',
        'tipo',
        'descripcion',
        'periodo_id'
    ];

    public function periodo(): BelongsTo
    {
        return $this->belongsTo(Periodo::class);
    }
}
