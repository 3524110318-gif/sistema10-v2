<?php

//RH
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RH\DashboardController;
use App\Http\Controllers\RH\EmpleadoController;
use App\Http\Controllers\RH\DocumentoController;
use App\Http\Controllers\RH\CalendarioLaboralController;
use App\Http\Controllers\RH\VacacionController;
use App\Http\Controllers\RH\IncidenciaController;
use App\Http\Controllers\RH\EntregaUniformeController;
use App\Http\Controllers\RH\VigenciaController;
use App\Http\Controllers\RH\CapacitacionController;
use App\Http\Controllers\RH\ProspectoController;
use App\Http\Controllers\RH\BajaEmpleadoController;

/*
| DASHBOARD RH
*/

Route::middleware(['auth', 'role:rh'])->group(function ()
    {

    Route::get('/rh/dashboard', [DashboardController::class, 'index'])
        ->name('rh.dashboard');

    Route::get('/rh/empleados', [EmpleadoController::class, 'index'])
        ->name('rh.empleados');

    Route::get('/rh/empleados/create', [EmpleadoController::class, 'create'])
        ->name('rh.empleados.create');

    Route::post('/rh/empleados', [EmpleadoController::class, 'store'])
        ->name('rh.empleados.store');

    Route::get('/rh/empleados/inactivos',[EmpleadoController::class, 'inactivos'])
        ->name('rh.empleados.inactivos');

    Route::get('/rh/empleados/{id}',[EmpleadoController::class, 'show'])
        ->name('rh.empleados.show');

    Route::get('/rh/empleados/{id}/edit',[EmpleadoController::class, 'edit'])
        ->name('rh.empleados.edit');

    Route::put('/rh/empleados/{id}',[EmpleadoController::class, 'update'])
        ->name('rh.empleados.update');

    Route::put('/rh/empleados/{id}/reactivar',[EmpleadoController::class, 'reactivar'])
        ->name('rh.empleados.reactivar');

    Route::post('/rh/empleados/{empleado}/documentos',[DocumentoController::class, 'store'])
        ->name('rh.documentos.store');

    Route::patch('/rh/empleados/{empleado}/documentos/pendiente',[DocumentoController::class, 'pendiente'])
        ->name('rh.documentos.pendiente');

    Route::get('/rh/calendario',[CalendarioLaboralController::class, 'index'])
        ->name('rh.calendario.index');

    Route::get('/rh/calendario/create',[CalendarioLaboralController::class, 'create'])
        ->name('rh.calendario.create');

    Route::post('/rh/calendario',[CalendarioLaboralController::class, 'store'])
        ->name('rh.calendario.store');

    Route::get('/calendario/{calendario}/editar',[CalendarioLaboralController::class, 'edit'])
        ->name('rh.calendario.edit');
    
    Route::put('/calendario/{calendario}',[CalendarioLaboralController::class, 'update'])
        ->name('rh.calendario.update');
    
    Route::delete('/calendario/{calendario}',[CalendarioLaboralController::class, 'destroy'])
        ->name('rh.calendario.destroy');
 
    Route::get('/rh/vacaciones',[VacacionController::class, 'index'])
        ->name('rh.vacaciones.index');

    Route::get('/rh/vacaciones/create',[VacacionController::class, 'create'])
        ->name('rh.vacaciones.create');

    Route::post('/rh/vacaciones',[VacacionController::class, 'store'])
        ->name('rh.vacaciones.store');

    Route::get('/rh/vacaciones/{vacacion}/edit',[VacacionController::class, 'edit'])
        ->name('rh.vacaciones.edit');

    Route::put('/rh/vacaciones/{vacacion}',[VacacionController::class, 'update'])
        ->name('rh.vacaciones.update');

    Route::delete('/rh/vacaciones/{vacacion}',[VacacionController::class, 'destroy'])
        ->name('rh.vacaciones.destroy');

    Route::patch('/rh/vacaciones/{vacacion}/cancelar',[VacacionController::class, 'cancelar'])
        ->name('rh.vacaciones.cancelar');

    Route::patch('/rh/vacaciones/{vacacion}/aprobar',[VacacionController::class, 'aprobar'])
        ->name('rh.vacaciones.aprobar');

    Route::patch('/rh/vacaciones/{vacacion}/rechazar',[VacacionController::class, 'rechazar'])
        ->name('rh.vacaciones.rechazar');

    Route::get('/rh/incidencias',[IncidenciaController::class, 'index'])
        ->name('rh.incidencias.index');

    Route::get('/rh/incidencias/create',[IncidenciaController::class, 'create'])
        ->name('rh.incidencias.create');

    Route::post('/rh/incidencias',[IncidenciaController::class, 'store'])
        ->name('rh.incidencias.store');

    Route::patch('/rh/incidencias/{incidencia}/justificar',[IncidenciaController::class, 'justificar'])
        ->name('rh.incidencias.justificar');

    Route::patch('/rh/incidencias/{incidencia}/injustificar',[IncidenciaController::class, 'injustificar'])
        ->name('rh.incidencias.injustificar');

    Route::get('/rh/expedientes-incompletos',[DashboardController::class, 'expedientesIncompletos'])
        ->name('rh.expedientes.incompletos');

    Route::get('/rh/empleados/{id}/ficha',[EmpleadoController::class, 'fichaTecnica'])
        ->name('rh.empleados.ficha');

    Route::get('/rh/empleados/{id}/credencial',[EmpleadoController::class, 'credencial'])
        ->name('rh.empleados.credencial');

    Route::get('/rh/empleados/{empleado}/uniformes/create',[EntregaUniformeController::class, 'create'])
        ->name('rh.uniformes.create');

    Route::post('/rh/empleados/{empleado}/uniformes',[EntregaUniformeController::class, 'store'])
        ->name('rh.uniformes.store');

    Route::get('/rh/empleados/{empleado}/vigencias/create',[VigenciaController::class, 'create'])
        ->name('rh.vigencias.create');

    Route::post('/rh/empleados/{empleado}/vigencias',[VigenciaController::class, 'store'])
        ->name('rh.vigencias.store');

    Route::get('/rh/empleados/{empleado}/capacitaciones/create',[CapacitacionController::class, 'create'])
        ->name('rh.capacitaciones.create');

    Route::post('/rh/empleados/{empleado}/capacitaciones',[CapacitacionController::class, 'store'])
        ->name('rh.capacitaciones.store');

    Route::get('/rh/prospectos',[ProspectoController::class, 'index'])
        ->name('rh.prospectos.index');

    Route::get('/rh/prospectos/create',[ProspectoController::class, 'create'])
        ->name('rh.prospectos.create');

    Route::post('/rh/prospectos',[ProspectoController::class, 'store'])
        ->name('rh.prospectos.store');

    Route::post('/rh/prospectos/{id}/entrevistar',[ProspectoController::class, 'entrevistar'])
        ->name('rh.prospectos.entrevistar');

    Route::post('/rh/prospectos/{id}/aprobar',[ProspectoController::class, 'aprobar'])
        ->name('rh.prospectos.aprobar');

    Route::post('/rh/prospectos/{id}/rechazar',[ProspectoController::class, 'rechazar'])
        ->name('rh.prospectos.rechazar');

    Route::post('/rh/prospectos/{id}/contratar',[ProspectoController::class, 'contratar'])
        ->name('rh.prospectos.contratar');

    Route::get('/rh/empleados/{empleado}/baja',[BajaEmpleadoController::class, 'create'])
        ->name('rh.bajas.create');

    Route::post('/rh/empleados/{empleado}/baja',[BajaEmpleadoController::class, 'store'])
        ->name('rh.bajas.store');

    }
);
