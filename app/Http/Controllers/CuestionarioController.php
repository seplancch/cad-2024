<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuestionario;
use App\Models\Rubro;

class CuestionarioController extends Controller
{
    public function index()
    {
        return view('cuestionarios');
    }

    public function show($id)
    {
        $preguntas = Cuestionario::find($id)->preguntas;
        //$rubros = $preguntas->groupBy('rubro_id');
        $rubros = Rubro::all();

        return view('show-cuestionario', compact('preguntas', 'rubros'));
    }
}
