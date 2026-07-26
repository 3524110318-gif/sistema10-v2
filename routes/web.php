<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if (! Auth::check()) {
        return redirect()->route('login');
    }

    return match (Auth::user()->rol) {

        'rh' => redirect()->route('rh.dashboard'),

        'administracion' => redirect()->route('administracion.dashboard'),

        'comercial' => redirect()->route('comercial.dashboard'),

        'operaciones' => redirect()->route('operaciones.dashboard'),

        'repse' => redirect()->route('repse.dashboard'),

        'gerencia' => redirect()->route('gerencia.dashboard'),

        default => abort(403, 'ROL NO AUTORIZADO'),
    };

});

require __DIR__.'/auth.php';
require __DIR__.'/rh.php';
require __DIR__.'/operaciones.php';
require __DIR__.'/administracion.php';
require __DIR__.'/comercial.php';
require __DIR__.'/repse.php';
require __DIR__.'/gerencia.php';