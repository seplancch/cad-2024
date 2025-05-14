<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ConfiguracionController extends Controller
{
    public function index()
    {
        $configuraciones = Configuracion::all();
        return view('configuracion.index', compact('configuraciones'));
    }

    public function create()
    {
        return view('configuracion.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:configuraciones',
            'valor' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',
        ]);

        Configuracion::create($request->all());

        return redirect()->route('configuracion.index')
            ->with('success', 'Configuración creada exitosamente.');
    }

    public function edit(Configuracion $configuracion)
    {
        return view('configuracion.edit', compact('configuracion'));
    }

    public function update(Request $request, Configuracion $configuracion)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:configuraciones,nombre,' . $configuracion->id,
            'valor' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',
        ]);

        $configuracion->update($request->all());

        return redirect()->route('configuracion.index')
            ->with('success', 'Configuración actualizada exitosamente.');
    }

    public function destroy(Configuracion $configuracion)
    {
        $configuracion->delete();

        return redirect()->route('configuracion.index')
            ->with('success', 'Configuración eliminada exitosamente.');
    }
} 