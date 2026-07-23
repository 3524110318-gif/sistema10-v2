<?php

namespace App\Http\Controllers\Repse;

use App\Http\Controllers\Controller;
use App\Models\Repse;

class DashboardController extends Controller
{
    public function index()
    {
        return view('repse.dashboard', [

            'total' => Repse::count(),

            'cumplen' => Repse::where(
                'estatus',
                'cumple'
            )->count(),

            'pendientes' => Repse::where(
                'estatus',
                'pendiente'
            )->count(),

            'bloqueados' => Repse::where(
                'estatus',
                'bloqueado'
            )->count(),

            'porVencer' => Repse::whereNotNull(
                'vigencia_cedula_ssp'
            )
            ->whereDate(
                'vigencia_cedula_ssp',
                '>=',
                now()->startOfDay()
            )
            ->whereDate(
                'vigencia_cedula_ssp',
                '<=',
                now()->copy()->addDays(30)
            )
            ->count(),

        ]);
    }
}