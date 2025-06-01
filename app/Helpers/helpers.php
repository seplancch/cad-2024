<?php

namespace App\Helpers;

use App\Models\Configuracion;
use App\Models\User;
use App\Models\Periodo;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

if (! function_exists('compruebaEstadoInscripciones')) {
    function compruebaEstadoInscripciones($userid)
    {
        $estadoInscripciones = [];
        $usuario = User::find($userid);
        $periodoActual = obtieneidPeriodoActual();
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
            return $periodo ? $periodo->clave : null;
        }
        return null;
    }
}

if (!function_exists('verificaCuestionarioServiciosUnam')) {
    function verificaCuestionarioServiciosUnam($numeroCuenta)
    {
        try {
            $response = Http::timeout(5)->get('https://cad.cch.unam.mx/servicios-unam/consulta_completo.php', [
                'cuenta' => $numeroCuenta
            ]);
            if ($response->successful()) {
                $json = $response->json();
                if (isset($json['completo'])) {
                    return (int)$json['completo'];
                }
            }
        } catch (\Exception $e) {
            Log::error('Error al consultar servicios UNAM: ' . $e->getMessage());
        }
        return 0;
    }
}
