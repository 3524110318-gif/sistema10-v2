<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Repse\DashboardController;
use App\Http\Controllers\Repse\RepseController;
use App\Http\Controllers\Repse\GeneradorMensualController;
use App\Http\Controllers\Repse\RepseArchivoController;


Route::middleware(['auth', 'role:repse'])->group(function () {

    Route::get('/repse/dashboard',[DashboardController::class, 'index'])
        ->name('repse.dashboard');

    Route::resource('repse/expedientes',RepseController::class)
        ->parameters(['expedientes' => 'expediente']);

    Route::get('/repse/generador-mensual',[GeneradorMensualController::class, 'index'])
        ->name('repse.generador.index');

    Route::post('/repse/generador-mensual',[GeneradorMensualController::class, 'generar'])
        ->name('repse.generador.generar');

    Route::post('/repse/generador-mensual/descargar',[GeneradorMensualController::class, 'descargar'])
        ->name('repse.generador.descargar');

    Route::post('/repse/generador-mensual/archivos',[RepseArchivoController::class, 'guardarArchivo'])
        ->name('repse.generador.archivos.guardar');

    Route::get('/repse/generador-mensual/resultado',[GeneradorMensualController::class, 'resultado'])
        ->name('repse.generador.resultado');
   
    Route::delete('/repse/generador-mensual/archivos/{archivo}',[RepseArchivoController::class, 'eliminarArchivo'])
        ->name('repse.generador.archivos.eliminar');
});