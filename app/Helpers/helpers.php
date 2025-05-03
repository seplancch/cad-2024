<?php

namespace App\Helpers;

use App\Models\Configuracion;
use App\Models\User;

function compruebaEstadoInscripciones($userid)
{
    $estadoInscripciones = [];
    $usuario = User::find($userid);
    $periodoActual = obtienePeriodoActual();
    $inscripciones = $usuario->inscripcion->where('periodo_id', $periodoActual);
    $estadoInscripciones['numeroGrupos'] = count($inscripciones);
    $estadoInscripciones['estado'] = 0;


    $estadoInscripciones['completados'] = 0;

    foreach ($inscripciones as $inscripcion) {
        if ($inscripcion->estado == 1) {
            $estadoInscripciones['completados']++;
        }
    }

    if ($estadoInscripciones['completados'] ==  $estadoInscripciones['numeroGrupos']) {
        $estadoInscripciones['estado'] = 1;
    }

    return (object) $estadoInscripciones;
}


function obtienePeriodoActual()
{
    return Configuracion::find(1)->periodo->id;
}
