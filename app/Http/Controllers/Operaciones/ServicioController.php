<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use App\Models\Operaciones\Servicio;
use App\Models\Operaciones\Contrato;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $servicios = Servicio::with([
            'contrato.cliente'
        ])

        ->when(
            $buscar,
            function ($query) use ($buscar) {

                $query

                ->where(
                    'nombre',
                    'like',
                    "%{$buscar}%"
                )

                ->orWhere(
                    'municipio',
                    'like',
                    "%{$buscar}%"
                )

                ->orWhereHas(
                    'contrato',
                    function ($q) use ($buscar) {

                        $q->where(
                            'numero_contrato',
                            'like',
                            "%{$buscar}%"
                        )

                        ->orWhereHas(
                            'cliente',
                            function ($cliente) use ($buscar) {

                                $cliente->where(
                                    'razon_social',
                                    'like',
                                    "%{$buscar}%"
                                );

                            }
                        );

                    }
                );

            }
        )

        ->latest()

        ->paginate(10)

        ->withQueryString();

        return view(
            'operaciones.servicios.index',
            compact(
                'servicios',
                'buscar'
            )
        );
    }

    public function create()
    {
        $contratos = Contrato::where(
            'estado',
            'activo'
        )->get();

        return view(
            'operaciones.servicios.create',
            compact('contratos')
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'contrato_id' =>
                'required|exists:contratos,id',

            'nombre' =>
                'required|string|max:255',

            'direccion' =>
                'required|string|max:500',

            'municipio' =>
                'nullable|string|max:255',

        ]);

        Servicio::create([

            'contrato_id' =>
                $request->contrato_id,

            'nombre' =>
                $request->nombre,

            'direccion' =>
                $request->direccion,

            'municipio' =>
                $request->municipio,

            'latitud' =>
                null,

            'longitud' =>
                null,

            'estado' =>
                'activo',

        ]);

        return redirect()

            ->route(
                'operaciones.servicios.index'
            )

            ->with(
                'success',
                'Servicio registrado correctamente.'
            );
    }

    public function show(Servicio $servicio)
    {
        $servicio->load([
            'contrato.cliente',
            'plazas.asignaciones.empleado',
            'incidencias',
        ]);

        $totalPlazas =
            $servicio->plazas->count();

        $cubiertas =
            $servicio->plazas
            ->where(
                'estado',
                'cubierta'
            )
            ->count();

        $vacantes =
            $servicio->plazas
            ->where(
                'estado',
                'vacante'
            )
            ->count();

        $cobertura =
            $totalPlazas > 0
                ? round(
                    ($cubiertas / $totalPlazas)
                    * 100,
                    2
                )
                : 0;

        $supervisiones = \App\Models\Operaciones\Supervision::whereHas(
            'asignacion.plaza',
            function ($query) use ($servicio) {

                $query->where(
                    'servicio_id',
                    $servicio->id
                );

            }
        )
        ->latest()
        ->get();

        $evidencias = \App\Models\Operaciones\Evidencia::whereHas(
            'supervision.asignacion.plaza',
            function ($query) use ($servicio) {

                $query->where(
                    'servicio_id',
                    $servicio->id
                );

            }
        )
        ->latest()
        ->get();

        return view(
            'operaciones.servicios.show',
            compact(
                'servicio',
                'totalPlazas',
                'cubiertas',
                'vacantes',
                'cobertura',
                'supervisiones',
                'evidencias'

            )
        );
    }
    public function edit(Servicio $servicio)
    {
        $contratos = Contrato::where(
            'estado',
            'activo'
        )->get();

        return view(
            'operaciones.servicios.edit',
            compact(
                'servicio',
                'contratos'
            )
        );
    }

    public function update(Request $request, Servicio $servicio)
    {
        $request->validate([

            'contrato_id' =>
                'required|exists:contratos,id',

            'nombre' =>
                'required|string|max:255',

            'direccion' =>
                'required|string|max:500',

            'municipio' =>
                'nullable|string|max:255',

            'latitud' =>
                'nullable|numeric',

            'longitud' =>
                'nullable|numeric',

            'estado' =>
                'required|in:activo,suspendido,finalizado',

        ]);

        $servicio->update([

            'contrato_id' =>
                $request->contrato_id,

            'nombre' =>
                $request->nombre,

            'direccion' =>
                $request->direccion,

            'municipio' =>
                $request->municipio,

            'latitud' =>
                $request->latitud,

            'longitud' =>
                $request->longitud,

            'estado' =>
                $request->estado,

        ]);

        return redirect()

            ->route(
                'operaciones.servicios.index'
            )

            ->with(
                'success',
                'Servicio actualizado correctamente.'
            );
    }

    public function destroy(Servicio $servicio)
    {
        if(
            $servicio
                ->plazas()
                ->exists()
        )
        {
            return redirect()

                ->route(
                    'operaciones.servicios.index'
                )

                ->with(
                    'error',
                    'No se puede eliminar el servicio porque tiene plazas registradas.'
                );
        }

        $servicio->delete();

        return redirect()

            ->route(
                'operaciones.servicios.index'
            )

            ->with(
                'success',
                'Servicio eliminado correctamente.'
            );
    }
}
