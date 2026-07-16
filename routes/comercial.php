<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Comercial\DashboardController;
use App\Http\Controllers\Comercial\ProspectoComercialController;
use App\Http\Controllers\Comercial\ClienteComercialController;
use App\Http\Controllers\Comercial\CotizacionController;
use App\Http\Controllers\Comercial\ContratoComercialController;


Route::middleware(['auth', 'role:comercial'])->group(function () {

    Route::get('/comercial/dashboard',[DashboardController::class, 'index'])
        ->name('comercial.dashboard');

    Route::resource('prospectos-comerciales',ProspectoComercialController::class)
        ->parameters(['prospectos-comerciales' => 'prospecto'])
        ->names('comercial.prospectos');

    Route::resource('clientes-comerciales',ClienteComercialController::class)
        ->parameters(['clientes-comerciales' => 'cliente'])
        ->names('comercial.clientes');

    Route::resource('cotizaciones',CotizacionController::class)
        ->names('comercial.cotizaciones');

    Route::resource('contratos-comerciales',ContratoComercialController::class)
        ->parameters(['contratos-comerciales' => 'contrato',])
        ->names('comercial.contratos');

});