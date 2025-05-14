<?php

namespace App\Http\Controllers\Inicio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        return view('inicio.inicio');
    }

    public function contacto()
    {
        return view('inicio.contacto');
    }

    public function creditos()
    {
        return view('inicio.creditos');
    }

    public function preguntasFrecuentes()
    {
        return view('inicio.preguntas-frecuentes');
    }

    public function queEs()
    {
        return view('inicio.que-es');
    }

    public function recursos()
    {
        return view('inicio.recursos');
    }
}
