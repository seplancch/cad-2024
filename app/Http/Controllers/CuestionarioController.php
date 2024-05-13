<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuestionario;
use App\Models\Inscripcion;
use App\Models\Periodo;
use App\Models\Rubro;

class CuestionarioController extends Controller
{
    public function index()
    {
        return view('cuestionarios');
    }

    public function show($id)
    {

        $inscripcion = Inscripcion::where('id', $id)->first();

        if($inscripcion->estado == '1'){

            return redirect()->route('dashboard')
            ->with('error','¡Este profesor ya ha sido evaluado!.');
        }else{

            $periodo = Periodo::where('clave', '2024-2')->first();
            $preguntas = Cuestionario::find($periodo->cuestionario_id)->preguntas;
            $rubros = Rubro::all();

            return view('show-cuestionario', compact('preguntas', 'rubros', 'id'));
        }

    }
}
