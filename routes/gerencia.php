<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Gerencia\GerenciaController;
use App\Http\Controllers\Gerencia\NominaVipController;
use App\Http\Controllers\Gerencia\CodigoAccesoController;
use App\Http\Controllers\Gerencia\CarpetaFlashController;

Route::middleware(['auth', 'role:gerencia'])->group(function ()
{

    Route::get('/gerencia/dashboard', [GerenciaController::class, 'dashboard'])
        ->name('gerencia.dashboard');

    Route::get(
    '/gerencia/nomina-vip',
    [NominaVipController::class, 'index']
)->name('gerencia.nomina-vip.index');

Route::put(
    '/gerencia/codigos/{codigo}/regenerar',
    [CodigoAccesoController::class, 'regenerar']
)->name('gerencia.codigos.regenerar');

Route::resource(
    '/gerencia/codigos',
    CodigoAccesoController::class
)
    ->except(['show'])
    ->names('gerencia.codigos');

    Route::get(
    '/gerencia/carpeta-flash',
    [CarpetaFlashController::class, 'index']
)->name('gerencia.carpeta-flash.index');


Route::get(
    '/gerencia/carpeta-flash/descargar',
    [CarpetaFlashController::class, 'descargar']
)->name('gerencia.carpeta-flash.descargar');

});