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
use DB;

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
            DB::beginTransaction();

            try {
                $profesorExists = Profesor::where('rfc', $record['rfc'])->exists();

                if (!User::where('username', $record['rfc'])->exists()) {
                    $usuario = User::create([
                        'username' => $record['rfc'],
                        'name' => $record['nombre'] . ' ' . $record['paterno'] . ' ' . $record['materno'],
                        'email' => $record['rfc'] . '@example.com',
                        'password' => bcrypt($record['ntrabajador']), // O puedes usar 'password' => Hash::make($record['rfc']),
                        'tipo' => 'P'
                    ]);

                    $profesor = $usuario->profesor()->create([
                        'numero_trabajador' => $record['ntrabajador'],
                        'rfc' => $record['rfc'],
                        'plantel_id' => 1,
                        'turno' => $record['turno'],
                        'fecha_nacimiento' => '1990-01-01',
                        'antiguedad' => isset($record['antiguedad']) ? $record['antiguedad'] : 'null',
                        'sexo' => isset($record['sexo']) ? $record['sexo'] : 'null',
                    ]);

                    $profesor->grupo()->create([
                        'nombre' => $record['grupo'],
                        'seccion' => $record['seccion'],
                        'plantel_id' => Plantel::getIdPlantel($record['plantel']),
                        'asignatura_id' => Asignatura::getIdAsignatura($record['asignatura']),
                        'periodo_id' => 1,
                    ]);
                } elseif (!$profesorExists) {
                    $usuario = User::where('username', $record['rfc'])->first();
                    $usuario->profesor()->create([
                        'numero_trabajador' => $record['ntrabajador'],
                        'rfc' => $record['rfc'],
                        'plantel_id' => 1,
                        'turno' => $record['turno'],
                        'fecha_nacimiento' => '1990-01-01',
                        'antiguedad' => isset($record['antiguedad']) ? $record['antiguedad'] : 'null',
                        'sexo' => isset($record['sexo']) ? $record['sexo'] : 'null',
                    ]);
                } else {
                    $profesor = Profesor::where('rfc', $record['rfc'])->first();
                    $profesor->grupo()->create([
                        'nombre' => $record['grupo'],
                        'seccion' => $record['seccion'],
                        'plantel_id' => Plantel::getIdPlantel($record['plantel']),
                        'asignatura_id' => Asignatura::getIdAsignatura($record['asignatura']),
                        'periodo_id' => 1,
                    ]);
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('error', 'Ocurrió un error al importar los datos: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Los alumnos se han importado correctamente.');
    }
}
