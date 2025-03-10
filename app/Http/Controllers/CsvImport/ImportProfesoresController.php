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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

/**
 * Controller for importing profesores from a CSV file.
 *
 * @category CSVImport
 * @package  App\Http\Controllers\CsvImport
 * @author   Jonathan Bailon Segura <jonn59@gmail.com>
 * @license  MIT License
 * @link     http://example.com
 */
class ImportProfesoresController extends Controller
{
    /**
     * Display the import profesores view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('import.profesores');
    }

    /**
     * Import profesores from a CSV file.
     *
     * @param \Illuminate\Http\Request $request The request object containing the CSV file.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {

        $request->validate([
            'archivo_csv' => 'required|file|mimes:csv',
        ]);
        Log::info('Inicia la importacion de profesores');

        $csv = Reader::createFromPath($request->file('archivo_csv')->getRealPath(), 'r');
        $csv->setHeaderOffset(0);

        //ini_set('max_execution_time', 18000);

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

        Log::info('Se han importado ' . $conteoCarga . ' registros de profesores correctamente.');
        return back()->with(
            'success',
            'Se han importado ' . $conteoCarga . ' registros de profesores correctamente.'
        );
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
        $profesorExists = Profesor::where('rfc', $record['rfc'])->exists();

        if (!User::where('username', $record['rfc'])->exists()) {
            $usuario = $this->createUser($record);
            $profesor = $this->createProfesor($usuario, $record);
            $this->_createGrupoIfNotExists($profesor, $record);
        } elseif (!$profesorExists) {
            $usuario = User::where('username', $record['rfc'])->first();
            $profesor = $this->createProfesor($usuario, $record);
            $this->createGrupoIfNotExists($profesor, $record);
        } else {
            $profesor = Profesor::where('rfc', $record['rfc'])->first();
            $this->createGrupoIfNotExists($profesor, $record);
        }
    }

    /**
     * Create a new user from the given record.
     *
     * @param array $record The record containing user information.
     *
     * @return \App\Models\User
     */
    private function _createUser($record)
    {
        return User::create(
            [
                'username' => $record['rfc'],
                'name' => $record['nombre'] . ' ' . $record['paterno'] . ' ' . $record['materno'],
                'email' => $record['rfc'] . '@example.com',
                'password' => bcrypt($record['ntrabajador']), // O puedes usar 'password' => Hash::make($record['rfc']),
                'tipo' => 'P'
            ]
        );
    }

    /**
     * Create a new profesor from the given user and record.
     *
     * @param \App\Models\User $usuario The user model.
     * @param array $record The record containing profesor information.
     *
     * @return \App\Models\Profesor
     */
    private function _createProfesor($usuario, $record)
    {
        return $usuario->profesor()->create(
            [
                'numero_trabajador' => $record['ntrabajador'],
                'rfc' => $record['rfc'],
                'plantel_id' => 1,
                'turno' => $record['turno'],
                'fecha_nacimiento' => '1990-01-01',
                'antiguedad' => !empty($record['antiguedad']) ? $record['antiguedad'] : 0,
                'sexo' => !empty($record['sexo']) ? $record['sexo'] : 'M',
            ]
        );
    }

    /**
     * Create a new grupo if it does not exist.
     *
     * @param \App\Models\Profesor $profesor The profesor model.
     * @param array $record The record containing grupo information.
     *
     * @return void
     */
    private function _createGrupoIfNotExists($profesor, $record)
    {
        $grupoExists = Grupo::where(
            [
                ['nombre', '=', $record['grupo']],
                ['seccion', '=', $record['seccion']],
                ['plantel_id', '=', Plantel::getIdPlantel($record['plantel'])],
                ['asignatura_id', '=', Asignatura::getIdAsignatura($record['asignatura'])],
                ['periodo_id', '=', 1]
            ]
        )->exists();

        if (!$grupoExists) {
            $profesor->grupo()->create(
                [
                    'nombre' => $record['grupo'],
                    'seccion' => $record['seccion'],
                    'plantel_id' => Plantel::getIdPlantel($record['plantel']),
                    'asignatura_id' => Asignatura::getIdAsignatura($record['asignatura']),
                    'periodo_id' => 1,
                ]
            );
        }
    }
}
