<?php

namespace App\Helpers;

use App\Models\User;

function compruebaEstadoInscripciones($userid)
{
    $estadoInscripciones = [];
    $usuario = User::find($userid);
    $inscripciones = $usuario->inscripcion;
    $estadoInscripciones['numeroGrupos'] = count($inscripciones);
    $estadoInscripciones['estado'] = 0;


    $estadoInscripciones['completados'] = 0;

    foreach ($inscripciones as $inscripcion) {
        if ($inscripcion->estado == 1) {
            $estadoInscripciones['completados']++;
        }
    }

    if($estadoInscripciones['completados'] ==  $estadoInscripciones['numeroGrupos']){
        $estadoInscripciones['estado'] = 1;
    }

   return (object) $estadoInscripciones;
}
