<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    public function index()
    {
        return view('periodos');
    }
}
