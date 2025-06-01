<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComprobanteCad extends Model
{
    use HasFactory;

    protected $table = 'comprobantes_cad';

    protected $fillable = [
        'user_id',
        'clave_comprobante',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
