<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administracion\Activo;
use App\Models\Administracion\Producto;
use App\Models\Administracion\LogActividad;
use Illuminate\Support\Facades\Auth;

class ActivoController extends Controller
{
    /**
     * Mostrar listado de activos.
     */
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $activos = Activo::with('producto');

        if ($buscar) {

            $activos->where(function ($query) use ($buscar) {

                $query->where(
                    'codigo_activo',
                    'like',
                    "%{$buscar}%"
                )
                ->orWhere(
                    'marca',
                    'like',
                    "%{$buscar}%"
                )
                ->orWhere(
                    'modelo',
                    'like',
                    "%{$buscar}%"
                );

            });

        }

        $activos = $activos
            ->orderByDesc('id')
            ->paginate(10);

        return view(
            'administracion.activos.index',
            compact(
                'activos'
            )
        );
    }

    /**
     * Mostrar formulario.
     */
    public function create()
    {
        $productos = Producto::where(
            'estado',
            'activo'
        )
        ->orderBy('nombre')
        ->get();

        return view(
            'administracion.activos.create',
            compact(
                'productos'
            )
        );
    }

    /**
     * Guardar activo.
     */
    public function store(Request $request)
    {
        $request->validate([

            'producto_id' => [
                'required',
                'exists:productos,id',
            ],

            'numero_serie' => [
                'nullable',
                'string',
                'max:100',
            ],

            'marca' => [
                'nullable',
                'string',
                'max:100',
            ],

            'modelo' => [
                'nullable',
                'string',
                'max:100',
            ],

            'fecha_adquisicion' => [
                'nullable',
                'date',
            ],

            'valor' => [
                'required',
                'numeric',
                'min:0',
            ],

            'estado' => [
                'required',
                'in:disponible,asignado,mantenimiento,baja',
            ],

            'observaciones' => [
                'nullable',
                'string',
            ],

        ]);

        $ultimoId = Activo::max('id') + 1;

        $codigo = 'ACT-' . str_pad(
            $ultimoId,
            5,
            '0',
            STR_PAD_LEFT
        );

        $activo = Activo::create([

            'producto_id' => $request->producto_id,

            'codigo_activo' => $codigo,

            'numero_serie' => $request->numero_serie,

            'marca' => $request->marca,

            'modelo' => $request->modelo,

            'fecha_adquisicion' => $request->fecha_adquisicion,

            'valor' => $request->valor,

            'estado' => $request->estado,

            'observaciones' => $request->observaciones,

        ]);

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' => 'Creó el activo ' . $activo->codigo_activo,

        ]);

        return redirect()
            ->route('administracion.activos.index')
            ->with(
                'success',
                'Activo registrado correctamente.'
            );
    }

    /**
     * Mostrar activo.
     */
    public function show(Activo $activo)
    {
        $activo->load('producto');

        return view(
            'administracion.activos.show',
            compact(
                'activo'
            )
        );
    }

    /**
     * Formulario de edición.
     */
    public function edit(Activo $activo)
    {
        $productos = Producto::where(
            'estado',
            'activo'
        )
        ->orderBy('nombre')
        ->get();

        return view(
            'administracion.activos.edit',
            compact(
                'activo',
                'productos'
            )
        );
    }

    /**
     * Actualizar activo.
     */
    public function update(
        Request $request,
        Activo $activo
    )
    {
        $request->validate([

            'producto_id' => [
                'required',
                'exists:productos,id',
            ],

            'numero_serie' => [
                'nullable',
                'string',
                'max:100',
            ],

            'marca' => [
                'nullable',
                'string',
                'max:100',
            ],

            'modelo' => [
                'nullable',
                'string',
                'max:100',
            ],

            'fecha_adquisicion' => [
                'nullable',
                'date',
            ],

            'valor' => [
                'required',
                'numeric',
                'min:0',
            ],

            'estado' => [
                'required',
                'in:disponible,asignado,mantenimiento,baja',
            ],

            'observaciones' => [
                'nullable',
                'string',
            ],

        ]);

        $activo->update([

            'producto_id' => $request->producto_id,

            'numero_serie' => $request->numero_serie,

            'marca' => $request->marca,

            'modelo' => $request->modelo,

            'fecha_adquisicion' => $request->fecha_adquisicion,

            'valor' => $request->valor,

            'estado' => $request->estado,

            'observaciones' => $request->observaciones,

        ]);

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' => 'Actualizó el activo ' . $activo->codigo_activo,

        ]);

        return redirect()
            ->route('administracion.activos.index')
            ->with(
                'success',
                'Activo actualizado correctamente.'
            );
    }

    /**
     * Cambiar estado del activo.
     */
    public function destroy(Activo $activo)
    {
        $activo->update([

            'estado' => $activo->estado == 'baja'
                ? 'disponible'
                : 'baja',

        ]);

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' => 'Cambió el estado del activo ' . $activo->codigo_activo,

        ]);

        return redirect()
            ->route('administracion.activos.index')
            ->with(
                'success',
                'Estado del activo actualizado correctamente.'
            );
    }
}
