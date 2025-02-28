<?php

namespace App\Http\Controllers\CsvImport;

use App\Http\Controllers\Controller;
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

class ImportProfesoresController extends Controller
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

       // ini_set('max_execution_time', 18000);

        $startTime = time();
        $maxExecutionTime = ini_get('max_execution_time') - 5; // 5 segundos de margen

        foreach ($csv as $record) {
            if ((time() - $startTime) > $maxExecutionTime) {
                return back()->with('error', 'El tiempo máximo de ejecución se ha superado.');
            }

            DB::beginTransaction();

            try {
                $this->processRegistro($record);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('error', 'Ocurrió un error al importar los datos: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Los alumnos se han importado correctamente.');
    }

    private function processRegistro($record)
    {
        $profesorExists = Profesor::where('rfc', $record['rfc'])->exists();

        if (!User::where('username', $record['rfc'])->exists()) {
            $usuario = $this->createUser($record);
            $profesor = $this->createProfesor($usuario, $record);
            $this->createGrupoIfNotExists($profesor, $record);
        } elseif (!$profesorExists) {
            $usuario = User::where('username', $record['rfc'])->first();
            $profesor = $this->createProfesor($usuario, $record);
            $this->createGrupoIfNotExists($profesor, $record);
        } else {
            $profesor = Profesor::where('rfc', $record['rfc'])->first();
            $this->createGrupoIfNotExists($profesor, $record);
        }
    }

    private function createUser($record)
    {
        return User::create([
            'username' => $record['rfc'],
            'name' => $record['nombre'] . ' ' . $record['paterno'] . ' ' . $record['materno'],
            'email' => $record['rfc'] . '@example.com',
            'password' => bcrypt($record['ntrabajador']), // O puedes usar 'password' => Hash::make($record['rfc']),
            'tipo' => 'P'
        ]);
    }

    private function createProfesor($usuario, $record)
    {
        return $usuario->profesor()->create([
            'numero_trabajador' => $record['ntrabajador'],
            'rfc' => $record['rfc'],
            'plantel_id' => 1,
            'turno' => $record['turno'],
            'fecha_nacimiento' => '1990-01-01',
            'antiguedad' => !empty($record['antiguedad']) ? $record['antiguedad'] : 0,
            'sexo' => !empty($record['sexo']) ? $record['sexo'] : 'M',
        ]);
    }

    private function createGrupoIfNotExists($profesor, $record)
    {
        $grupoExists = Grupo::where([
            ['nombre', '=', $record['grupo']],
            ['seccion', '=', $record['seccion']],
            ['plantel_id', '=', Plantel::getIdPlantel($record['plantel'])],
            ['asignatura_id', '=', Asignatura::getIdAsignatura($record['asignatura'])],
            ['periodo_id', '=', 1]
        ])->exists();

        if (!$grupoExists) {
            $profesor->grupo()->create([
                'nombre' => $record['grupo'],
                'seccion' => $record['seccion'],
                'plantel_id' => Plantel::getIdPlantel($record['plantel']),
                'asignatura_id' => Asignatura::getIdAsignatura($record['asignatura']),
                'periodo_id' => 1,
            ]);
        }
    }
}
