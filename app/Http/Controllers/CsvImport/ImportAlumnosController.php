<?php

namespace App\Http\Controllers\CsvImport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use League\Csv\Reader;
use App\Models\Asignatura;
use App\Models\Grupo;
use App\Models\Plantel;
use App\Models\Alumno;
use App\Models\Inscripcion;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use function App\Helpers\obtieneIdPeriodoActual;
use function App\Helpers\obtienePeriodoActual;

/**
 * Controller for importing alumnos from a CSV file.
 *
 * @category CSVImport
 * @package  App\Http\Controllers\CsvImport
 * @author   Jonathan Bailon Segura <jonn59@gmail.com>
 * @license  MIT License
 * @link     http://example.com
 */
class ImportAlumnosController extends Controller
{
    /**
     * Display the import alumnos view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $periodoActual = obtienePeriodoActual();
        return view('import.alumnos', compact('periodoActual'));
    }

    /**
     * Import alumnos from a CSV file.
     *
     * @param \Illuminate\Http\Request $request The request object containing the CSV file.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {

        $request->validate(
            [
                'archivo_csv' => 'required|file|mimes:csv',
            ]
        );

        Log::info('Inicia la importacion de alumnos');

        $csv = Reader::createFromPath($request->file('archivo_csv')->getRealPath(), 'r');
        $csv->setHeaderOffset(0);

        ini_set('max_execution_time', 18000);
        ini_set('memory_limit', -1);

        $startTime = time();
        $maxExecutionTime = ini_get('max_execution_time') - 5; // 5 segundos de margen

        $conteoCarga = 0;
        foreach ($csv as $record) {
            if ((time() - $startTime) > $maxExecutionTime) {
                log::error('El tiempo máximo de ejecución se ha superado. <br />Solo se procesaron ' . $conteoCarga . ' registros.');

                return back()->with(
                    'error',
                    'El tiempo máximo de ejecución se ha superado. Solo se procesaron ' . $conteoCarga . ' registros.'
                );
            }

            DB::beginTransaction();

            try {
                $this->processRegistro($record);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('error', 'Ocurrió un error al importar los datos: ' . $e->getMessage());
            }
            $conteoCarga++;
        }

        Log::info('Se han importado ' . $conteoCarga . ' registros de alumnos correctamente.');
        return back()->with(
            'success',
            'Se han importado ' . $conteoCarga . ' registros de alumnos correctamente.'
        );
    }

    private function isEmptyOrZero($value)
    {
        return $value === 0 || $value === null || $value === '';
    }

    /**
     * Process a single record from the CSV file.
     *
     * @param array $record The record to process.
     *
     * @return void
     */
    private function processRegistro($record)
    {
        $alumnoExist = Alumno::where('numero_cuenta', $record['id_alumno'])->exists();

        if ($this->isEmptyOrZero($record['plantel'])
            || $this->isEmptyOrZero($record['asignatura'])
            || $this->isEmptyOrZero($record['grupo'])
        ) {
                Log::error('Para el alumno ' . $record['id_alumno'] . ' no se han encontrado datos de plantel: ' . $record['plantel'] .', asignatura: ' . $record['asignatura'] .' o grupo:' . $record['asignatura'] .'.');
        } else {
            if (!User::where('username', $record['id_alumno'])->exists()) {
                $usuario = $this->createUser($record);
                if ($usuario) {
                    $alumno = $this->createAlumno($usuario, $record);
                    $this->createSemestre($alumno, $record);
                    $this->createInscripcionIfNotExists($alumno, $record);
                } else {
                    Log::error('Error al crear el usuario para: ' . $record['id_alumno']);
                    throw new \Exception('Error al crear el usuario para: ' . $record['id_alumno']);
                }
            } elseif (!$alumnoExist) {
                $usuario = User::where('username', $record['id_alumno'])->first();
                $alumno = $this->createAlumno($usuario, $record);
                $this->createSemestre($alumno, $record);
                $this->createInscripcionIfNotExists($alumno, $record);
            } else {
                $alumno = Alumno::where('numero_cuenta', $record['id_alumno'])->first();
                $this->createInscripcionIfNotExists($alumno, $record);
            }
        }
    }

    /**
     * Create a new user from the given record.
     *
     * @param array $record The record containing user information.
     *
     * @return \App\Models\User
     */
    private function createUser($record)
    {
        return User::create(
            [
                'username' => $record['id_alumno'],
                'name' => $record['nombre'] . ' ' . $record['paterno'] . ' ' . $record['materno'],
                'nombre' => $record['nombre'],
                'apaterno' => $record['paterno'],
                'amaterno' => $record['materno'],
                'email' => $record['email'],
                'password' => bcrypt($record['fecha_nacimiento']), // O puedes usar 'password' => Hash::make($record['rfc']),
                'tipo' => 'A'
            ]
        );
    }

    /**
     * Create a new alumno from the given user and record.
     *
     * @param \App\Models\User $usuario The user model.
     * @param array $record The record containing alumno information.
     *
     * @return \App\Models\Alumno
     */
    private function createAlumno($usuario, $record)
    {
        return $usuario->alumno()->create(
            [
                'numero_cuenta' => $record['id_alumno'],
                'plantel_id' => $record['plantel'],
                'fecha_nacimiento' => $record['fecha_nacimiento'],
                'sexo' => !empty($record['sexo']) ? $record['sexo'] : 'M',
            ]
        );
    }

    /**
     * Create a new grupo if it does not exist.
     *
     * @param \App\Models\Alumno $alumno The alumno model.
     * @param array $record The record containing grupo information.
     *
     * @return void
     */
    private function createInscripcionIfNotExists($alumno, $record)
    {
        try{
            $idGrupo = Grupo::getGrupoId(
                $record['grupo'],
                $record['seccion'],
                $record['asignatura'],
                $record['plantel']
            );

            $inscripcionExists = Inscripcion::where(
                [
                    ['alumno_id', '=', $alumno->id],
                    ['grupo_id', '=', $idGrupo],
                    ['activa', '=', 1],
                    ['periodo_id', '=', obtieneIdPeriodoActual()],
                ]
            )->exists();

            if (!$inscripcionExists) {
                if (!$idGrupo) {
                    Log::error('Grupo: '. $record['grupo'] .' no encontrado para el alumno: ' . $alumno->numero_cuenta .' asignatura: ' . $record['asignatura'] .' plantel: ' . $record['plantel'] .'seccion: ' . $record['seccion'] .'');
                } else {
                    $alumno->inscripcion()->create(
                        [
                            'alumno_id' => $alumno->id,
                            'grupo_id' => $idGrupo,
                            'activa' => 1,
                            'periodo_id' => obtieneIdPeriodoActual(),
                            'autoinscripcion' => 0,
                        ]
                    );
                }
            }
        } catch (\Exception $e) {
            Log::error('Error al crear la inscripción para el alumno: ' . $alumno->numero_cuenta . ' - ' . $e->getMessage());
            throw new \Exception('Error al crear la inscripción: '.$e->getMessage());
        }
    }

    /**
     * Create a new semestre if it does not exist.
     *
     * @param \App\Models\Alumno $alumno The alumno model.
     * @param array $record The record containing grupo information.
     *
     * @return void
     */
    private function createSemestre($alumno, $record)
    {
        $semestre = $record['semestre'];

        return $alumno->semestre()->create(
            [
                'alumno_id' => $alumno->id,
                'periodo_id' => obtieneIdPeriodoActual(),
                'numero_semestre' => $record['semestre'],
            ]
        );
    }
}
