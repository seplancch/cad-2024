<?php

namespace App\Http\Controllers\CsvImport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use League\Csv\Reader;
use App\Models\Asignatura;
use App\Models\Grupo;
use App\Models\Plantel;
use App\Models\Alumno;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use DB;

class CsvImportAlumnosController extends Controller
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

        ini_set('max_execution_time', 18000);

        $startTime = time();
        $maxExecutionTime = ini_get('max_execution_time') - 5; // 5 segundos de margen

        foreach ($csv as $record) {
            if ((time() - $startTime) > $maxExecutionTime) {
                return back()->with('error', 'El tiempo máximo de ejecución se ha superado.');
            }

            DB::beginTransaction();

            try {
                $this->processRecord($record);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('error', 'Ocurrió un error al importar los datos: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Los alumnos se han importado correctamente.');
    }

    private function processRecord($record)
    {
        $alumnoExists = Alumno::where('matricula', $record['matricula'])->exists();

        if (!User::where('username', $record['matricula'])->exists()) {
            $usuario = $this->createUser($record);
            $alumno = $this->createAlumno($usuario, $record);
            $this->createGrupoIfNotExists($alumno, $record);
        } elseif (!$alumnoExists) {
            $usuario = User::where('username', $record['matricula'])->first();
            $alumno = $this->createAlumno($usuario, $record);
            $this->createGrupoIfNotExists($alumno, $record);
        } else {
            $alumno = Alumno::where('matricula', $record['matricula'])->first();
            $this->createGrupoIfNotExists($alumno, $record);
        }
    }

    private function createUser($record)
    {
        return User::create([
            'username' => $record['matricula'],
            'name' => $record['nombre'] . ' ' . $record['paterno'] . ' ' . $record['materno'],
            'email' => $record['matricula'] . '@example.com',
            'password' => bcrypt($record['matricula']), // O puedes usar 'password' => Hash::make($record['matricula']),
            'tipo' => 'A'
        ]);
    }

    private function createAlumno($usuario, $record)
    {
        return $usuario->alumno()->create([
            'matricula' => $record['matricula'],
            'fecha_nacimiento' => $record['fecha_nacimiento'],
            'sexo' => !empty($record['sexo']) ? $record['sexo'] : 'M',
        ]);
    }

    private function createGrupoIfNotExists($alumno, $record)
    {
        $grupoExists = Grupo::where([
            ['nombre', '=', $record['grupo']],
            ['seccion', '=', $record['seccion']],
            ['plantel_id', '=', Plantel::getIdPlantel($record['plantel'])],
            ['asignatura_id', '=', Asignatura::getIdAsignatura($record['asignatura'])],
            ['periodo_id', '=', 1]
        ])->exists();

        if (!$grupoExists) {
            $alumno->grupo()->create([
                'nombre' => $record['grupo'],
                'seccion' => $record['seccion'],
                'plantel_id' => Plantel::getIdPlantel($record['plantel']),
                'asignatura_id' => Asignatura::getIdAsignatura($record['asignatura']),
                'periodo_id' => 1,
            ]);
        }
    }
}
