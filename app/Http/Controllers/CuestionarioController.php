<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuestionario;

class CuestionarioController extends Controller
{
    public function index()
    {
        return view('cuestionarios');
    }

    public function show($id)
    {
        $preguntas = Cuestionario::find($id)->preguntas;

        return view('show-cuestionario', compact('preguntas'));
    }
}
