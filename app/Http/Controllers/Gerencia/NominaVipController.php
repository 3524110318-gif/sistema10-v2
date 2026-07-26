<?php

namespace App\Http\Controllers\Gerencia;

use App\Http\Controllers\Controller;
use App\Models\RH\Empleado;
use Illuminate\Http\Request;

class NominaVipController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $empleados = Empleado::query()

            ->where('estado', 'activo')

            ->whereIn('rango', [
                'Directivo',
                'Gerente',
                'Coordinador',
                'Supervisor',
            ])

            ->when(
                $buscar,
                function ($query, $buscar) {

                    $query->where(
                        function ($subquery) use ($buscar) {

                            $subquery
                                ->where(
                                    'numero_control',
                                    'like',
                                    '%' . $buscar . '%'
                                )
                                ->orWhere(
                                    'nombre',
                                    'like',
                                    '%' . $buscar . '%'
                                )
                                ->orWhere(
                                    'apellido_paterno',
                                    'like',
                                    '%' . $buscar . '%'
                                )
                                ->orWhere(
                                    'apellido_materno',
                                    'like',
                                    '%' . $buscar . '%'
                                )
                                ->orWhere(
                                    'puesto',
                                    'like',
                                    '%' . $buscar . '%'
                                )
                                ->orWhere(
                                    'rango',
                                    'like',
                                    '%' . $buscar . '%'
                                );

                        }
                    );

                }
            )

            ->orderBy('rango')

            ->orderBy('apellido_paterno')

            ->paginate(10)

            ->withQueryString();


        $totalMensual = Empleado::where(
            'estado',
            'activo'
        )
            ->whereIn('rango', [
                'Directivo',
                'Gerente',
                'Coordinador',
                'Supervisor',
            ])
            ->sum('salario_base');


        return view(
            'gerencia.nomina-vip.index',
            compact(
                'empleados',
                'totalMensual'
            )
        );
    }
}