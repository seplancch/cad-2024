<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreguntaController extends Controller
{
    public function index($id)
    {
        return view('preguntas', compact('id'));
    }
}
