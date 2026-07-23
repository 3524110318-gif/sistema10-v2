<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

/*
Route::middleware(['auth', 'role:gerencia'])->group(function () {

    Route::get('/gerencia/dashboard', function () {

        return 'DASHBOARD GERENCIA';

    });

});
*/

require __DIR__.'/auth.php';
require __DIR__.'/rh.php';
require __DIR__.'/operaciones.php';
require __DIR__.'/administracion.php';
require __DIR__.'/comercial.php';
require __DIR__.'/repse.php';

//require __DIR__.'/gerencia.php';


