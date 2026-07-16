<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administracion\DashboardController;
use App\Http\Controllers\Administracion\LogActividadController;
use App\Http\Controllers\Administracion\CategoriaProductoController;
use App\Http\Controllers\Administracion\ProductoController;
use App\Http\Controllers\Administracion\ProveedorController;
use App\Http\Controllers\Administracion\CompraController;
use App\Http\Controllers\Administracion\ActivoController;
use App\Http\Controllers\Administracion\AsignacionActivoController;
use App\Http\Controllers\Administracion\FacturaController;
use App\Http\Controllers\Administracion\CobranzaController;
use App\Http\Controllers\Administracion\PrenominaController;
/*
| DASHBOARD ADMINISTRACION
*/

Route::middleware(['auth', 'role:administracion'])->group(function () {

   /* Route::get('/administracion/dashboard',[LogActividadController::class, 'index'])
        ->name('administracion.dashboard');*/

    Route::get('/administracion/dashboard',[DashboardController::class, 'index'])
        ->name('administracion.dashboard');

    Route::get('/administracion/logs',[LogActividadController::class, 'index'])
        ->name('administracion.logs');

    Route::resource('categorias',CategoriaProductoController::class)
        ->names('administracion.categorias');

    Route::resource('productos',ProductoController::class)
        ->names('administracion.productos');

    Route::get('/proveedores',[ProveedorController::class, 'index'])
        ->name('administracion.proveedores.index');

    Route::get('/proveedores/create',[ProveedorController::class, 'create'])
        ->name('administracion.proveedores.create');

    Route::post('/proveedores',[ProveedorController::class, 'store'])
        ->name('administracion.proveedores.store');

    Route::get('/proveedores/{proveedor}/edit',[ProveedorController::class, 'edit'])
        ->name('administracion.proveedores.edit');

    Route::put('/proveedores/{proveedor}',[ProveedorController::class, 'update'])
        ->name('administracion.proveedores.update');

    Route::delete('/proveedores/{proveedor}',[ProveedorController::class, 'destroy'])
        ->name('administracion.proveedores.destroy');

    Route::resource('compras',CompraController::class)
        ->names('administracion.compras');

    Route::resource('activos',ActivoController::class)
        ->names('administracion.activos');

    Route::resource('asignaciones-activos',AsignacionActivoController::class)
        ->names('administracion.asignaciones-activos');

    Route::resource('facturas',FacturaController::class)
        ->names('administracion.facturas');

    Route::resource('cobranzas',CobranzaController::class)
        ->names('administracion.cobranzas');

    Route::resource('prenominas',PrenominaController::class)
        ->names('administracion.prenominas');

});
