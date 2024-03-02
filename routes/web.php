<?php

use App\Http\Controllers\CuestionarioController;
use App\Http\Controllers\RubroController;
use App\Http\Controllers\PreguntaController;
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

    Route::get('/preguntas/{id}', [PreguntaController::class, 'index'])->name('preguntas');

    Route::get('/cuestionarios/{id}', [CuestionarioController::class, 'show'])->name('cuestionario');
});


