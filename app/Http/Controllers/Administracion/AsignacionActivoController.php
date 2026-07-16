<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administracion\AsignacionActivo;
use App\Models\Administracion\Activo;
use App\Models\RH\Empleado;
use App\Models\Operaciones\Servicio;
use App\Models\Administracion\LogActividad;
use Illuminate\Support\Facades\Auth;

class AsignacionActivoController extends Controller
{
    /**
     * Mostrar listado de asignaciones.
     */
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $asignaciones = AsignacionActivo::with([
            'activo',
            'empleado',
            'servicio'
        ]);

        if ($buscar) {

            $asignaciones->whereHas(
                'activo',
                function ($query) use ($buscar)
                {
                    $query->where(
                        'codigo_activo',
                        'like',
                        "%{$buscar}%"
                    );
                }
            );

        }

        $asignaciones = $asignaciones
            ->orderByDesc('id')
            ->paginate(10);

        return view(
            'administracion.asignaciones-activos.index',
            compact('asignaciones')
        );
    }

    /**
     * Mostrar formulario.
     */
    public function create()
    {
        $activos = Activo::where(
            'estado',
            'disponible'
        )->orderBy(
            'codigo_activo'
        )->get();

        $empleados = Empleado::where(
            'estado',
            'activo'
        )->orderBy(
            'nombre'
        )->get();

        $servicios = Servicio::orderBy(
            'nombre'
        )->get();

        return view(
            'administracion.asignaciones-activos.create',
            compact(
                'activos',
                'empleados',
                'servicios'
            )
        );
    }

    /**
     * Guardar asignación.
     */
    public function store(Request $request)
    {
        $request->validate([

            'activo_id' => 'required|exists:activos,id',

            'empleado_id' => 'required|exists:empleados,id',

            'servicio_id' => 'nullable|exists:servicios,id',

            'fecha_entrega' => 'required|date',

            'fecha_devolucion' => 'nullable|date',

            'estado' => 'required|in:activa,devuelta',

            'observaciones' => 'nullable|string',

        ]);

        $asignacion = AsignacionActivo::create(

            $request->all()

        );

        $asignacion->activo->update([

            'estado' => 'asignado',

        ]);

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' =>

            'Asignó el activo '

            .

            $asignacion->activo->codigo_activo

            .

            ' al empleado '

            .

            $asignacion->empleado->nombre

            .

            ' '

            .

            $asignacion->empleado->apellido_paterno,

        ]);

        return redirect()

            ->route(
                'administracion.asignaciones-activos.index'
            )

            ->with(

                'success',

                'Activo asignado correctamente.'

            );
    }

    /**
     * Mostrar asignación.
     */
    public function show(
        AsignacionActivo $asignaciones_activo
    )
    {
        return view(

            'administracion.asignaciones-activos.show',

            [

                'asignacion' => $asignaciones_activo

            ]

        );
    }

    /**
     * Editar asignación.
     */
    public function edit(
        AsignacionActivo $asignaciones_activo
    )
    {
        $activos = Activo::orderBy(
            'codigo_activo'
        )->get();

        $empleados = Empleado::where(
            'estado',
            'activo'
        )->orderBy(
            'nombre'
        )->get();

        $servicios = Servicio::orderBy(
            'nombre'
        )->get();

        return view(

            'administracion.asignaciones-activos.edit',

            [

                'asignacion' => $asignaciones_activo,

                'activos' => $activos,

                'empleados' => $empleados,

                'servicios' => $servicios,

            ]

        );
    }

    /**
     * Actualizar asignación.
     */
    public function update(
        Request $request,
        AsignacionActivo $asignaciones_activo
    )
    {
        $request->validate([

            'activo_id' => 'required|exists:activos,id',

            'empleado_id' => 'required|exists:empleados,id',

            'servicio_id' => 'nullable|exists:servicios,id',

            'fecha_entrega' => 'required|date',

            'fecha_devolucion' => 'nullable|date',

            'estado' => 'required|in:activa,devuelta',

            'observaciones' => 'nullable|string',

        ]);

        $asignaciones_activo->update(

            $request->all()

        );

        if (

            $request->estado == 'devuelta'

        ) {

            $asignaciones_activo

            ->activo

            ->update([

                'estado' => 'disponible'

            ]);

        }

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' =>

            'Actualizó la asignación del activo '

            .

            $asignaciones_activo

            ->activo

            ->codigo_activo,

        ]);

        return redirect()

            ->route(
                'administracion.asignaciones-activos.index'
            )

            ->with(

                'success',

                'Asignación actualizada correctamente.'

            );
    }

    /**
     * Cambiar estado.
     */
    public function destroy(
        AsignacionActivo $asignaciones_activo
    )
    {
        $asignaciones_activo->update([

            'estado' => 'devuelta',

            'fecha_devolucion' => now(),

        ]);

        $asignaciones_activo

        ->activo

        ->update([

            'estado' => 'disponible'

        ]);

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' =>

            'Registró la devolución del activo '

            .

            $asignaciones_activo

            ->activo

            ->codigo_activo,

        ]);

        return redirect()

            ->route(
                'administracion.asignaciones-activos.index'
            )

            ->with(

                'success',

                'Activo devuelto correctamente.'

            );
    }
}
