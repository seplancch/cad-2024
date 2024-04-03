<?php

use App\Http\Controllers\CuestionarioController;
use App\Http\Controllers\RubroController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/cuestionarios', [CuestionarioController::class, 'index'])->name('cuestionarios');
    Route::get('/rubros', [RubroController::class, 'index'])->name('rubros');
    Route::get('/preguntas', [PreguntaController::class, 'index'])->name('preguntas');
    Route::get('/cuestionarios/{id}', [CuestionarioController::class, 'show'])->name('cuestionario');
    Route::get('/periodos', [PeriodoController::class, 'index'])->name('periodos');

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('users', UserController::class);
});





