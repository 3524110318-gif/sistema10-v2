<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\Administracion\LogActividad;
use App\Models\Administracion\MovimientoInventario;
use App\Models\Administracion\Producto;
use App\Models\RH\Empleado;
use App\Models\RH\EntregaUniforme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EntregaUniformeController extends Controller
{
    public function create($empleadoId)
    {
        $empleado = Empleado::findOrFail(
            $empleadoId
        );

        /*
        |--------------------------------------------------------------------------
        | VALIDAR EMPLEADO ACTIVO
        |--------------------------------------------------------------------------
        */

        if ($empleado->estado !== 'activo') {

            return redirect()
                ->route(
                    'rh.empleados.show',
                    $empleado->id
                )
                ->with(
                    'error',
                    'No puedes registrar entregas de uniforme para un empleado inactivo.'
                );

        }

        $productos = Producto::where(
            'estado',
            'activo'
        )
            ->where(
                'tipo_producto',
                'consumible'
            )
            ->where(
                'stock_actual',
                '>',
                0
            )
            ->orderBy('nombre')
            ->get();

        return view(
            'rh.uniformes.create',
            compact(
                'empleado',
                'productos'
            )
        );
    }

    public function store(
        Request $request,
        $empleadoId
    ) {
        $empleado = Empleado::findOrFail(
            $empleadoId
        );

        /*
        |--------------------------------------------------------------------------
        | VALIDAR EMPLEADO ACTIVO
        |--------------------------------------------------------------------------
        */

        if ($empleado->estado !== 'activo') {

            return redirect()
                ->route(
                    'rh.empleados.show',
                    $empleado->id
                )
                ->with(
                    'error',
                    'No puedes registrar entregas de uniforme para un empleado inactivo.'
                );

        }

        $datos = $request->validate(
            [
                'producto_id' => [
                    'required',
                    'integer',
                    'exists:productos,id',
                ],

                'cantidad' => [
                    'required',
                    'integer',
                    'min:1',
                ],

                'tipo' => [
                    'required',
                    'in:nuevo,segunda_mano',
                ],

                'fecha_entrega' => [
                    'required',
                    'date',
                    'before_or_equal:today',
                ],

                'observaciones' => [
                    'nullable',
                    'string',
                    'max:500',
                ],
            ],
            [
                'producto_id.required' =>
                    'Debes seleccionar un producto del inventario.',

                'producto_id.integer' =>
                    'El producto seleccionado no es válido.',

                'producto_id.exists' =>
                    'El producto seleccionado no existe.',

                'cantidad.required' =>
                    'La cantidad es obligatoria.',

                'cantidad.integer' =>
                    'La cantidad debe ser un número entero.',

                'cantidad.min' =>
                    'La cantidad debe ser por lo menos 1.',

                'tipo.required' =>
                    'Debes seleccionar el tipo de entrega.',

                'tipo.in' =>
                    'El tipo de entrega seleccionado no es válido.',

                'fecha_entrega.required' =>
                    'La fecha de entrega es obligatoria.',

                'fecha_entrega.date' =>
                    'La fecha de entrega no es válida.',

                'fecha_entrega.before_or_equal' =>
                    'La fecha de entrega no puede ser posterior al día de hoy.',

                'observaciones.string' =>
                    'Las observaciones no son válidas.',

                'observaciones.max' =>
                    'Las observaciones no deben superar los 500 caracteres.',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | OBTENER Y VALIDAR PRODUCTO
        |--------------------------------------------------------------------------
        */

        $producto = Producto::where(
            'id',
            $datos['producto_id']
        )
            ->where(
                'estado',
                'activo'
            )
            ->where(
                'tipo_producto',
                'consumible'
            )
            ->first();

        if (!$producto) {

            return back()
                ->withInput()
                ->withErrors([
                    'producto_id' =>
                        'El producto no está disponible para entregas de uniforme.',
                ]);

        }

        if (
            $producto->stock_actual <
            $datos['cantidad']
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'cantidad' =>
                        'No hay suficiente stock disponible. Existencia actual: ' .
                        $producto->stock_actual .
                        '.',
                ]);

        }

        /*
        |--------------------------------------------------------------------------
        | REGISTRAR ENTREGA Y MOVIMIENTO
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $datos,
            $empleado,
            $producto
        ) {

            /*
             * Bloqueamos el producto mientras se calcula y actualiza el stock.
             * Esto evita que dos entregas simultáneas descuenten la misma existencia.
             */
            $productoBloqueado = Producto::where(
                'id',
                $producto->id
            )
                ->lockForUpdate()
                ->firstOrFail();

            if (
                $productoBloqueado->stock_actual <
                $datos['cantidad']
            ) {

                throw new \RuntimeException(
                    'El stock disponible cambió antes de registrar la entrega.'
                );

            }

            $stockAnterior =
                $productoBloqueado->stock_actual;

            $stockNuevo =
                $stockAnterior -
                $datos['cantidad'];

            EntregaUniforme::create([
                'empleado_id' =>
                    $empleado->id,

                'producto_id' =>
                    $productoBloqueado->id,

                'cantidad' =>
                    $datos['cantidad'],

                'articulo' =>
                    $productoBloqueado->nombre,

                'tipo' =>
                    $datos['tipo'],

                'fecha_entrega' =>
                    $datos['fecha_entrega'],

                'observaciones' =>
                    isset($datos['observaciones'])
                        ? trim($datos['observaciones'])
                        : null,
            ]);

            $productoBloqueado->update([
                'stock_actual' =>
                    $stockNuevo,
            ]);

            MovimientoInventario::create([
                'producto_id' =>
                    $productoBloqueado->id,

                'tipo_movimiento' =>
                    'salida',

                'cantidad' =>
                    $datos['cantidad'],

                'stock_anterior' =>
                    $stockAnterior,

                'stock_nuevo' =>
                    $stockNuevo,

                'fecha_movimiento' =>
                    now(),

                'user_id' =>
                    Auth::id(),

                'referencia' =>
                    'Entrega de uniforme al empleado ' .
                    $empleado->numero_control,

                'motivo' =>
                    'Entrega de uniforme',

                'observaciones' =>
                    isset($datos['observaciones'])
                        ? trim($datos['observaciones'])
                        : null,

                'origen' =>
                    'RH',
            ]);

            /*
            |--------------------------------------------------------------------------
            | REGISTRO DE ACTIVIDAD
            |--------------------------------------------------------------------------
            */

            LogActividad::create([
                'usuario' =>
                    Auth::user()->rol,

                'accion' =>
                    'Registró la entrega de ' .
                    $datos['cantidad'] .
                    ' unidad(es) de "' .
                    $productoBloqueado->nombre .
                    '" para el empleado ' .
                    $empleado->numero_control,
            ]);

        });

        return redirect()
            ->route(
                'rh.empleados.show',
                $empleado->id
            )
            ->with(
                'success',
                'Uniforme registrado y stock actualizado correctamente.'
            );
    }
}