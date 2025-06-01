<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatisfaccionEncuesta extends Model
{
    use HasFactory;
    protected $table = 'satisfaccion_encuestas';
    protected $fillable = [
        'user_id',
        'periodo',
        'pregunta_id',
        'pregunta_texto',
        'respuesta_texto',
        'respuesta_valor',
        'user_agent',
        'ip',
    ];
}
