<?php

use App\Http\Controllers\CsvImport\ImportAlumnosController;
use App\Http\Controllers\CsvImport\ImportProfesoresController;
use App\Http\Controllers\CuestionarioController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\RubroController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ResultadoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\Inicio\InicioController;
use App\Models\Profesor;
use App\Http\Controllers\ValidacionController;
use App\Http\Controllers\EvaluarController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Route::redirect('/', '/login');


Route::get('/', [InicioController::class, 'index'])->name('home');
Route::get('/contacto', [InicioController::class, 'contacto'])->name('contacto');
Route::post('/contacto', [InicioController::class, 'enviarContacto'])->name('contacto.enviar');
Route::get('/creditos', [InicioController::class, 'creditos'])->name('creditos');
Route::get('/preguntas-frecuentes', [InicioController::class, 'preguntasFrecuentes'])->name('preguntas-frecuentes');
Route::get('/que-es', [InicioController::class, 'queEs'])->name('que-es');
Route::get('/recursos', [InicioController::class, 'recursos'])->name('recursos');

Route::get('/contador', [App\Http\Controllers\ContadorController::class, 'index'])->name('contador.index');

Route::get('/estadisticas', [App\Http\Controllers\EstadisticasController::class, 'index'])->name('estadisticas.index');

// Ruta para validación de certificados CAD
Route::get('/validar/{codigo}', [ValidacionController::class, 'validar'])->name('validacion.certificado');

Route::middleware(
    [
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ]
)->group(
    function () {
        Route::get('/dashboard', [PanelController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/reporte', [PanelController::class, 'reporte'])->name('dashboard.reporte');

        // Rutas de evaluación
        Route::get('/evaluar/{id}', [EvaluarController::class, 'show'])->name('evaluar.show');
        Route::post('/evaluar/{id}', [EvaluarController::class, 'store'])->name('evaluar.store');

        Route::middleware(['role:Admin'])->group(
            function () {
                Route::resource('roles', RoleController::class);
                Route::resource('permissions', PermissionController::class);
                Route::resource('users', UserController::class);

                //Route::post('/importar', [ImportProfesoresController::class, 'import'])->name('importaProfesores');
                Route::get('/importar/profesores', [ImportProfesoresController::class, 'index']);
                Route::get('/importar/alumnos', [ImportAlumnosController::class, 'index']);
                Route::post('/importar/profesores', [ImportProfesoresController::class, 'import'])->name('importaProfesores');
                Route::post('/importar/alumnos', [ImportAlumnosController::class, 'import'])->name('importaAlumnos');
                
                Route::get('/cuestionarios', [CuestionarioController::class, 'index'])->name('cuestionarios');
                Route::get('/periodos', [PeriodoController::class, 'index'])->name('periodos');
                Route::get('/rubros', [RubroController::class, 'index'])->name('rubros');
                Route::get('/preguntas', [PreguntaController::class, 'index'])->name('preguntas');

                Route::get('profesores', [ProfesorController::class, 'index'])->name('profesores.index');
            }
        );
    }
);





