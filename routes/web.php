<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ProfesionalEspecialidadController;
use App\Http\Controllers\CupsEspecialidadController;
use App\Http\Controllers\HorarioProfesionalController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pacientes', PacienteController::class);

// ✅ Rutas para autocompletado de relaciones intermedias
Route::get('/relacion/profesional-especialidad', [ProfesionalEspecialidadController::class, 'buscar']);
Route::get('/relacion/cups-especialidad', [CupsEspecialidadController::class, 'buscar']);
Route::get('/relacion/horario-profesional', [HorarioProfesionalController::class, 'buscar']);
