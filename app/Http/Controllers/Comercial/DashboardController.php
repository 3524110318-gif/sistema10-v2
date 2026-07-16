<?php

namespace App\Http\Controllers\Comercial;

use App\Http\Controllers\Controller;
use App\Models\Comercial\ProspectoComercial;
use App\Models\Comercial\ClienteComercial;
use App\Models\Comercial\Cotizacion;
use App\Models\Comercial\ContratoComercial;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $prospectos = ProspectoComercial::count();

        $clientes = ClienteComercial::count();

        $cotizaciones = Cotizacion::count();

        $contratosActivos = ContratoComercial::where(
            'estado',
            'activo'
        )->count();

        $contratosPorVencer = ContratoComercial::where(
                'fecha_fin',
                '<=',
                Carbon::now()->addDays(60)
            )
            ->where(
                'estado',
                'activo'
            )
            ->orderBy(
                'fecha_fin'
            )
            ->get();

        return view(
            'comercial.dashboard',
            compact(
                'prospectos',
                'clientes',
                'cotizaciones',
                'contratosActivos',
                'contratosPorVencer'
            )
        );
    }
}