<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;

use App\Models\Administracion\Producto;
use App\Models\Administracion\Compra;
use App\Models\Administracion\Factura;
use App\Models\Administracion\Cobranza;
use App\Models\Administracion\Activo;
use App\Models\Administracion\Prenomina;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProductos = Producto::count();

        $totalCompras = Compra::count();

        $totalFacturas = Factura::count();

        $totalCobranzas = Cobranza::count();

        $totalActivos = Activo::count();

        $totalPrenominas = Prenomina::count();

        $stockCritico = Producto::whereColumn(
            'stock_actual',
            '<=',
            'stock_minimo'
        )->count();

        $cobranzasVencidas = Cobranza::where(
            'estado',
            'vencida'
        )->count();

        $prenominasAbiertas = Prenomina::where(
            'estatus',
            'abierta'
        )->count();

        return view(
            'administracion.dashboard',
            compact(

                'totalProductos',

                'totalCompras',

                'totalFacturas',

                'totalCobranzas',

                'totalActivos',

                'totalPrenominas',

                'stockCritico',

                'cobranzasVencidas',

                'prenominasAbiertas'

            )
        );
    }
}