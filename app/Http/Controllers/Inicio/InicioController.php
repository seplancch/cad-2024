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
        return view('pages.contacto');
    }

    public function creditos()
    {
        return view('pages.creditos');
    }

    public function preguntasFrecuentes()
    {
        return view('pages.preguntas-frecuentes');
    }

    public function queEs()
    {
        return view('pages.que-es');
    }

    public function recursos()
    {
        return view('pages.recursos');
    }
}
