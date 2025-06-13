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


if (!function_exists('convertLikertTo1To10')) {
    /**
     * Convierte un valor de escala Likert de 1-5 a una escala de 1-10.
     *
     * @param float|int $likertValue Valor en la escala original de 1 a 5.
     * @return float Valor convertido en la escala de 1 a 10.
     */
    function convertLikertTo1To10(float|int $likertValue): float {
        // Definir los rangos de las escalas
        $originalMin = 1;
        $originalMax = 5;
        $newMin = 1;
        $newMax = 10;

        // Asegurar que el valor de entrada esté dentro del rango esperado.
        // Si está fuera de rango, se devuelve el valor más cercano en la nueva escala.
        if ($likertValue < $originalMin) {
            return (float)$newMin;
        }
        if ($likertValue > $originalMax) {
            return (float)$newMax;
        }

        // Aplicar la fórmula de transformación lineal:
        // Valor_nuevo = ((Valor_original - Min_original) / (Max_original - Min_original)) * (Max_nuevo - Min_nuevo) + Min_nuevo
        $convertedValue = (($likertValue - $originalMin) / ($originalMax - $originalMin)) * ($newMax - $newMin) + $newMin;

        return $convertedValue;
    }
}

if (!function_exists('nivel_de_desempeno')) {
    /**
     * Determina el nivel de desempeño basado en la escala CAD.
     *
     * @param float $calificacion
     * @return string
     */
    function nivel_de_desempeno(float $calificacion): string
    {
        if ($calificacion >= 0 && $calificacion <= 6.0) {
            return 'Insatisfactorio';
        } elseif ($calificacion > 6.0 && $calificacion <= 7.0) {
            return 'Satisfactorio bajo';
        } elseif ($calificacion > 7.0 && $calificacion <= 8.0) {
            return 'Satisfactorio';
        } elseif ($calificacion > 8.0 && $calificacion <= 9.0) {
            return 'Satisfactorio alto';
        } elseif ($calificacion > 9.0 && $calificacion <= 10.0) {
            return 'Sobresaliente';
        } else {
            return 'Calificación fuera de rango';
        }
    }
}
