<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CuestionarioController extends Controller
{
    public function index()
    {
        return view('cuestionarios');
    }
}
