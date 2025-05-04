<?php

namespace App\Helpers;

use App\Models\Configuracion;
use App\Models\User;
use App\Models\Periodo;

if (! function_exists('compruebaEstadoInscripciones')) {
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
}

if (! function_exists('obtieneIdPeriodoActual')) {
    function obtieneIdPeriodoActual()
    {
        $config = Configuracion::where('nombre', 'PERIODO_ACTUAL')->first();
        return $config ? $config->valor : null;
    }
}

if (! function_exists('obtienePeriodoActual')) {
    function obtienePeriodoActual()
    {
        $periodoId = obtieneIdPeriodoActual();
        if ($periodoId) {
            $periodo = Periodo::find($periodoId);
            return $periodo ? $periodo->nombre : null;
        }
        return null;
    }
}
