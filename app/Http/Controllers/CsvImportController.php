<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Csv\Reader;
use App\Models\Asignatura;
use App\Models\Grupo;
use App\Models\Plantel;
use App\Models\Profesor;
use App\Models\User;
use Carbon\Carbon;
use DateTime;

class CsvImportController extends Controller
{

    public function index()
    {
        return view('import.index');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $csv = Reader::createFromPath($request->file('csv_file')->getRealPath(), 'r');
        $csv->setHeaderOffset(0);

        foreach ($csv as $record) {

            if(! User::where('username', $record['rfc'])->exists()){
                $usuario = User::create([
                    'username' => $record['rfc'],
                    'name' => $record['nombre']. ' ' . $record['paterno'] . ' ' . $record['materno'],
                    'email' => $record['rfc'].'@example.com',
                    'password' => bcrypt($record['ntrabajador']), // O puedes usar 'password' => Hash::make($record['rfc']),
                    'tipo' => 'P'
                ]);

                $profesor = $usuario->profesor()->create([
                    'numero_trabajador' => $record['ntrabajador'],
                    'rfc' => $record['rfc'],
                    'plantel_id' => 1,
                    'turno' => $record['turno'],
                    //'fecha_nacimiento' => Carbon::parse($record['nacimiento'])->format('Y-m-d'),
                    'fecha_nacimiento' => '1990-01-01',
                    'antiguedad' => isset($record['antiguedad']) ? $record['antiguedad'] : 'null',
                    'sexo' => isset($record['sexo']) ? $record['sexo'] : 'null',    // Agrega aquí los demás campos...
                ]);

                $profesor->grupo()->create([
                    'nombre' => $record['grupo'],
                    'seccion' => $record['seccion'],
                    'plantel_id' => Plantel::getIdPlantel($record['plantel']),
                    'asignatura_id' => Asignatura::getIdAsignatura($record['asignatura']),
                    'periodo_id' => 1,
                ]);
            }elseif(! Profesor::where('rfc', $record['rfc'])->exists()){
                $usuario = User::where('username', $record['rfc'])->first();
                $usuario->profesor()->create([
                    'numero_trabajador' => $record['ntrabajador'],
                    'rfc' => $record['rfc'],
                    'plantel_id' => 1,
                    'turno' => $record['turno'],
                    //'fecha_nacimiento' => Carbon::parse($record['nacimiento'])->format('Y-m-d'),
                    'fecha_nacimiento' => '1990-01-01',
                    'antiguedad' => isset($record['antiguedad']) ? $record['antiguedad'] : 'null',
                    'sexo' => isset($record['sexo']) ? $record['sexo'] : 'null',
                ]);
            /*}elseif(! Grupo::where('profesor_id', Profesor::where('rfc', $record['rfc'])->first()->id)->exists()){
                $profesor = Profesor::where('rfc', $record['rfc'])->first();
                $profesor->grupo()->create([
                    'nombre' => $record['grupo'],
                    'seccion' => $record['seccion'],
                    'plantel_id' => Plantel::getIdPlantel($record['plantel']),
                    'asignatura_id' => Asignatura::getIdAsignatura($record['asignatura']),
                    'periodo_id' => 1,
                ]);
            }else{
                return back()->with('error', 'El profesor con RFC: ' . $record['rfc'] . ' ya existe.');
            }*/
        }else{
            $profesor = Profesor::where('rfc', $record['rfc'])->first();
                $profesor->grupo()->create([
                    'nombre' => $record['grupo'],
                    'seccion' => $record['seccion'],
                    'plantel_id' => Plantel::getIdPlantel($record['plantel']),
                    'asignatura_id' => Asignatura::getIdAsignatura($record['asignatura']),
                    'periodo_id' => 1,
                ]);
        }


    }

        return back()->with('success', 'Los alumnos se han importado correctamente.');
    }
}
