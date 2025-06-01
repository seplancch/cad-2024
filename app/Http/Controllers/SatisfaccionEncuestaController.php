<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SatisfaccionEncuesta;

use function App\Helpers\obtieneIdPeriodoActual;

class SatisfaccionEncuestaController extends Controller
{
    public function store(Request $request)
    {
        $preguntas = config('satisfaccion_preguntas');
        $user_id = auth()->check() ? auth()->id() : null;
        $user_agent = $request->userAgent();
        $ip = $request->ip();
        $periodo = obtieneIdPeriodoActual();
        foreach ($preguntas as $idx => $pregunta) {
            $pid = $pregunta['id'];
            $ptexto = $pregunta['pregunta'];
            $respuesta = $request->input('pregunta_' . $idx);
            $rtexto = null;
            $rvalor = null;
            if ($pregunta['tipo'] === 'radio') {
                foreach ($pregunta['opciones'] as $op) {
                    if ((string)$op['valor'] === (string)$respuesta) {
                        $rtexto = $op['texto'];
                        $rvalor = $op['valor'];
                    }
                }
            } elseif ($pregunta['tipo'] === 'textarea') {
                $rtexto = $respuesta;
            }
            if ($respuesta !== null && ($rtexto !== null || $rvalor !== null)) {
                SatisfaccionEncuesta::create([
                    'user_id' => $user_id,
                    'periodo' => $periodo,
                    'pregunta_id' => $pid,
                    'pregunta_texto' => $ptexto,
                    'respuesta_texto' => $rtexto,
                    'respuesta_valor' => $rvalor,
                    'user_agent' => $user_agent,
                    'ip' => $ip,
                ]);
            }
        }
        return response()->json(['ok' => true]);
    }
}
