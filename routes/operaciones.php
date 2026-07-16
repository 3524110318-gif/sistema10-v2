<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Operaciones\ClienteController;
use App\Http\Controllers\Operaciones\ContratoController;
use App\Http\Controllers\Operaciones\ServicioController;
use App\Http\Controllers\Operaciones\PlazaOperativaController;
use App\Http\Controllers\Operaciones\AsignacionController;
use App\Http\Controllers\Operaciones\SupervisionController;
use App\Http\Controllers\Operaciones\EvidenciaController;
use App\Http\Controllers\Operaciones\IncidenciaOperativaController;
use App\Http\Controllers\Operaciones\DashboardController as OperacionesDashboardController;
use App\Http\Controllers\Operaciones\DobleteController;
use App\Http\Controllers\Operaciones\VehiculoController;
use App\Http\Controllers\Operaciones\MantenimientoVehicularController;

/*
| DASHBOARD OPERACIONES
*/

Route::middleware(['auth', 'role:operaciones'])->group(function ()
    {
        Route::get('/operaciones/dashboard',[OperacionesDashboardController::class, 'index'])
            ->name('operaciones.dashboard');

        Route::get('/clientes',[ClienteController::class, 'index'])
            ->name('operaciones.clientes.index');

        Route::get('/clientes/create',[ClienteController::class, 'create'])
            ->name('operaciones.clientes.create');

        Route::post('/clientes',[ClienteController::class, 'store'])
            ->name('operaciones.clientes.store');

        Route::get('/clientes/{cliente}',[ClienteController::class, 'show'])
            ->name('operaciones.clientes.show');

        Route::get('/clientes/{cliente}/edit',[ClienteController::class, 'edit'])
            ->name('operaciones.clientes.edit');

        Route::put('/clientes/{cliente}',[ClienteController::class, 'update'])
            ->name('operaciones.clientes.update');

        Route::delete('/clientes/{cliente}',[ClienteController::class, 'destroy'])
            ->name('operaciones.clientes.destroy');



        Route::get('/contratos',[ContratoController::class, 'index'])
            ->name('operaciones.contratos.index');

        Route::get('/contratos/create',[ContratoController::class, 'create'])
            ->name('operaciones.contratos.create');

        Route::post('/contratos',[ContratoController::class, 'store'])
            ->name('operaciones.contratos.store');

        Route::get('/contratos/{contrato}',[ContratoController::class, 'show'])
            ->name('operaciones.contratos.show');

        Route::get('/contratos/{contrato}/edit',[ContratoController::class, 'edit'])
            ->name('operaciones.contratos.edit');

        Route::put('/contratos/{contrato}',[ContratoController::class, 'update'])
            ->name( 'operaciones.contratos.update');

        Route::delete('/contratos/{contrato}',[ContratoController::class, 'destroy'])
            ->name( 'operaciones.contratos.destroy');



        Route::get('/servicios',[ServicioController::class, 'index'])
            ->name('operaciones.servicios.index');

        Route::get('/servicios/create',[ServicioController::class, 'create'])
            ->name('operaciones.servicios.create');

        Route::post('/servicios',[ServicioController::class, 'store'])
            ->name('operaciones.servicios.store');

        Route::get('/servicios/{servicio}',[ServicioController::class, 'show'])
            ->name('operaciones.servicios.show');

        Route::get('/servicios/{servicio}/edit',[ServicioController::class, 'edit'])
            ->name('operaciones.servicios.edit');

        Route::put('/servicios/{servicio}',[ServicioController::class, 'update'])
            ->name('operaciones.servicios.update');

        Route::delete('/servicios/{servicio}', [ServicioController::class,'destroy'])
            ->name('operaciones.servicios.destroy');



        Route::get('/plazas',[PlazaOperativaController::class, 'index'])
            ->name('operaciones.plazas.index');

        Route::get('/plazas/create',[PlazaOperativaController::class, 'create'])
            ->name('operaciones.plazas.create');

        Route::post('/plazas',[PlazaOperativaController::class, 'store'])
            ->name('operaciones.plazas.store');



        Route::get('/asignaciones',[AsignacionController::class, 'index'])
            ->name('operaciones.asignaciones.index');

        Route::get('/asignaciones/create',[AsignacionController::class, 'create'])
            ->name('operaciones.asignaciones.create');

        Route::post('/asignaciones',[AsignacionController::class, 'store'])
            ->name('operaciones.asignaciones.store');





        Route::get('/supervisiones',[SupervisionController::class, 'index'])
            ->name('operaciones.supervisiones.index');

        Route::get('/supervisiones/create',[SupervisionController::class, 'create'])
            ->name('operaciones.supervisiones.create');

        Route::post('/supervisiones',[SupervisionController::class, 'store'])
            ->name('operaciones.supervisiones.store');

        Route::get('/supervisiones/{supervision}',[SupervisionController::class, 'show'])
            ->name('operaciones.supervisiones.show');

        Route::get('/supervisiones/{supervision}/edit',[SupervisionController::class, 'edit'])
            ->name('operaciones.supervisiones.edit');

        Route::put('/supervisiones/{supervision}',[SupervisionController::class, 'update'])
            ->name('operaciones.supervisiones.update');




        Route::get('/evidencias',[EvidenciaController::class, 'index'])
            ->name('operaciones.evidencias.index');

        Route::get('/evidencias/create',[EvidenciaController::class, 'create'])
            ->name('operaciones.evidencias.create');

        Route::get('/evidencias/{evidencia}',[EvidenciaController::class, 'show'])
            ->name('operaciones.evidencias.show');

        Route::get('/evidencias/{evidencia}/edit',[EvidenciaController::class, 'edit'])
            ->name('operaciones.evidencias.edit');

        Route::put('/evidencias/{evidencia}',[EvidenciaController::class, 'update'])
            ->name('operaciones.evidencias.update');

        Route::post('/evidencias',[EvidenciaController::class, 'store'])
            ->name('operaciones.evidencias.store');



        Route::get('/incidencias-operativas',[IncidenciaOperativaController::class, 'index'])
            ->name('operaciones.incidencias.index');

        Route::get('/incidencias-operativas/create',[IncidenciaOperativaController::class, 'create'])
            ->name('operaciones.incidencias.create');

        Route::get('/incidencias-operativas/create/{supervision}',[IncidenciaOperativaController::class, 'createDesdeSupervision'])
            ->name('operaciones.incidencias.create.supervision');

        Route::post('/incidencias-operativas',[IncidenciaOperativaController::class, 'store'])
            ->name('operaciones.incidencias.store');

        Route::patch('/incidencias-operativas/{incidencia}/cerrar',[IncidenciaOperativaController::class, 'cerrar'])
            ->name('operaciones.incidencias.cerrar');

        Route::get('/incidencias-operativas/{incidencia}',[IncidenciaOperativaController::class, 'show'])
            ->name('operaciones.incidencias.show');

        Route::put('/incidencias/{incidencia}/cerrar',[IncidenciaOperativaController::class,'cerrar'])
            ->name('operaciones.incidencias.cerrar');



        Route::get('/dobletes',[DobleteController::class, 'index'])
            ->name('operaciones.dobletes.index');

        Route::get('/dobletes/create',[DobleteController::class, 'create'])
            ->name('operaciones.dobletes.create');

        Route::post('/dobletes',[DobleteController::class, 'store'])
            ->name('operaciones.dobletes.store');

        Route::patch('/dobletes/{doblete}/finalizar',[DobleteController::class, 'finalizar'])
            ->name('operaciones.dobletes.finalizar');



        Route::get('/vehiculos',[VehiculoController::class, 'index'])
            ->name('operaciones.vehiculos.index');

        Route::get('/vehiculos/create',[VehiculoController::class, 'create'])
            ->name('operaciones.vehiculos.create');

        Route::post('/vehiculos',[VehiculoController::class, 'store'])
            ->name('operaciones.vehiculos.store');

        Route::get('/vehiculos/{vehiculo}/edit',[VehiculoController::class, 'edit'])
            ->name('operaciones.vehiculos.edit');

        Route::put('/vehiculos/{vehiculo}',[VehiculoController::class, 'update'])
            ->name('operaciones.vehiculos.update');



        Route::get('/mantenimientos',[MantenimientoVehicularController::class, 'index'])
            ->name('operaciones.mantenimientos.index');

        Route::get('/mantenimientos/create',[MantenimientoVehicularController::class, 'create'])
            ->name('operaciones.mantenimientos.create');

        Route::post('/mantenimientos',[MantenimientoVehicularController::class, 'store'])
            ->name('operaciones.mantenimientos.store');

        Route::get('/mantenimientos/{mantenimiento}/edit',[MantenimientoVehicularController::class,'edit'])
            ->name('operaciones.mantenimientos.edit');

        Route::put('/mantenimientos/{mantenimiento}',[MantenimientoVehicularController::class,'update'])
            ->name('operaciones.mantenimientos.update');


    });
