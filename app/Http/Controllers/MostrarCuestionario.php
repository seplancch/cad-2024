<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MostrarCuestionario extends Controller
{
    public function index()
    {
        return view('encuestas');
    }
}
