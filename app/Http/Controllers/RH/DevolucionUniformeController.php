<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\Administracion\LogActividad;
use App\Models\Administracion\MovimientoInventario;
use App\Models\Administracion\Producto;
use App\Models\RH\DevolucionUniforme;
use App\Models\RH\EntregaUniforme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
use App\Services\ActividadService;

class DevolucionUniformeController extends Controller
{
    public function create(
        EntregaUniforme $entregaUniforme
    ) {
        $entregaUniforme->load([
            'empleado',
            'producto',
            'devoluciones',
        ]);

        $cantidadDevuelta =
            $entregaUniforme->devoluciones
                ->sum('cantidad');

        $cantidadPendiente =
            $entregaUniforme->cantidad
            -
            $cantidadDevuelta;

        if ($cantidadPendiente <= 0) {

            return redirect()
                ->route(
                    'rh.empleados.show',
                    $entregaUniforme->empleado_id
                )
                ->with(
                    'error',
                    'Esta entrega ya fue devuelta completamente.'
                );
        }

        return view(
            'rh.uniformes.devolucion',
            compact(
                'entregaUniforme',
                'cantidadDevuelta',
                'cantidadPendiente'
            )
        );
    }

    public function store(
        Request $request,
        EntregaUniforme $entregaUniforme
    ) {
        $datos = $request->validate(
            [
                'cantidad' => [
                    'required',
                    'integer',
                    'min:1',
                ],

                'fecha_devolucion' => [
                    'required',
                    'date',
                    'before_or_equal:today',
                    'after_or_equal:' .
                        $entregaUniforme
                            ->fecha_entrega
                            ->format('Y-m-d'),
                ],

                'resultado' => [
                    'required',
                    'in:reutilizable,merma',
                ],

                'observaciones' => [
                    'nullable',
                    'string',
                    'max:500',
                ],
            ],
            [
                'cantidad.required' =>
                    'La cantidad es obligatoria.',

                'cantidad.integer' =>
                    'La cantidad debe ser un número entero.',

                'cantidad.min' =>
                    'La cantidad debe ser por lo menos 1.',

                'fecha_devolucion.required' =>
                    'La fecha de devolución es obligatoria.',

                'fecha_devolucion.date' =>
                    'La fecha de devolución no es válida.',

                'fecha_devolucion.before_or_equal' =>
                    'La fecha de devolución no puede ser posterior al día de hoy.',

                'fecha_devolucion.after_or_equal' =>
                    'La devolución no puede ser anterior a la fecha de entrega.',

                'resultado.required' =>
                    'Debes indicar el resultado de la devolución.',

                'resultado.in' =>
                    'El resultado seleccionado no es válido.',

                'observaciones.string' =>
                    'Las observaciones no son válidas.',

                'observaciones.max' =>
                    'Las observaciones no deben superar los 500 caracteres.',
            ]
        );

        try {

            DB::transaction(function () use (
                $datos,
                $entregaUniforme
            ) {

                /*
                |--------------------------------------------------------------------------
                | BLOQUEAR ENTREGA
                |--------------------------------------------------------------------------
                */

                $entregaBloqueada =
                    EntregaUniforme::with('empleado')
                        ->where(
                            'id',
                            $entregaUniforme->id
                        )
                        ->lockForUpdate()
                        ->firstOrFail();

                /*
                |--------------------------------------------------------------------------
                | CALCULAR CANTIDAD PENDIENTE
                |--------------------------------------------------------------------------
                */

                $cantidadDevuelta =
                    DevolucionUniforme::where(
                        'entrega_uniforme_id',
                        $entregaBloqueada->id
                    )
                        ->sum('cantidad');

                $cantidadPendiente =
                    $entregaBloqueada->cantidad
                    -
                    $cantidadDevuelta;

                if ($cantidadPendiente <= 0) {

                    throw new \RuntimeException(
                        'Esta entrega ya fue devuelta completamente.'
                    );

                }

                if (
                    $datos['cantidad']
                    >
                    $cantidadPendiente
                ) {

                    throw new \RuntimeException(
                        'La cantidad a devolver supera las ' .
                        $cantidadPendiente .
                        ' unidad(es) pendientes.'
                    );

                }

                /*
                |--------------------------------------------------------------------------
                | BLOQUEAR PRODUCTO
                |--------------------------------------------------------------------------
                */

                $producto =
                    Producto::where(
                        'id',
                        $entregaBloqueada->producto_id
                    )
                        ->lockForUpdate()
                        ->firstOrFail();

                $stockAnterior =
                    $producto->stock_actual;

                $stockNuevo =
                    $stockAnterior;

                /*
                |--------------------------------------------------------------------------
                | ACTUALIZAR STOCK SI ES REUTILIZABLE
                |--------------------------------------------------------------------------
                */

                if (
                    $datos['resultado']
                    ===
                    'reutilizable'
                ) {

                    $stockNuevo =
                        $stockAnterior
                        +
                        $datos['cantidad'];

                    $producto->update([
                        'stock_actual' =>
                            $stockNuevo,
                    ]);

                }

                /*
                |--------------------------------------------------------------------------
                | REGISTRAR DEVOLUCIÓN
                |--------------------------------------------------------------------------
                */

                DevolucionUniforme::create([
                    'entrega_uniforme_id' =>
                        $entregaBloqueada->id,

                    'empleado_id' =>
                        $entregaBloqueada->empleado_id,

                    'producto_id' =>
                        $producto->id,

                    'cantidad' =>
                        $datos['cantidad'],

                    'fecha_devolucion' =>
                        $datos['fecha_devolucion'],

                    'resultado' =>
                        $datos['resultado'],

                    'observaciones' =>
                        !empty($datos['observaciones'])
                            ? trim($datos['observaciones'])
                            : null,

                    'user_id' =>
                        Auth::id(),
                ]);

                /*
                |--------------------------------------------------------------------------
                | MOVIMIENTO DE INVENTARIO
                |--------------------------------------------------------------------------
                */

                MovimientoInventario::create([
                    'producto_id' =>
                        $producto->id,

                    'tipo_movimiento' =>
                        $datos['resultado']
                        ===
                        'reutilizable'
                            ? 'devolucion'
                            : 'merma',

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
                        'Devolución de entrega EU-' .
                        str_pad(
                            $entregaBloqueada->id,
                            6,
                            '0',
                            STR_PAD_LEFT
                        ),

                    'motivo' =>
                        $datos['resultado']
                        ===
                        'reutilizable'
                            ? 'Uniforme reutilizable'
                            : 'Uniforme registrado como merma',

                    'observaciones' =>
                        !empty($datos['observaciones'])
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

                $identificadorEmpleado =
                    $entregaBloqueada
                        ->empleado
                        ?->numero_control
                    ??
                    $entregaBloqueada
                        ->empleado_id;

                ActividadService::registrar(

                    'Registró la devolución de '
                    . $datos['cantidad']
                    . ' unidad(es) de "'
                    . $producto->nombre
                    . '" como '
                    . $datos['resultado']
                    . ' para el empleado '
                    . $identificadorEmpleado,

                    null,

                    [

                        'producto_id' =>
                            $producto->id,

                        'producto' =>
                            $producto->nombre,

                        'cantidad' =>
                            $datos['cantidad'],

                        'resultado' =>
                            $datos['resultado'],

                        'empleado' =>
                            $identificadorEmpleado,

                    ]

                );

            });

        } catch (Throwable $e) {

            report($e);

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e instanceof \RuntimeException
                        ? $e->getMessage()
                        : 'No fue posible registrar la devolución.'
                );

        }

        return redirect()
            ->route(
                'rh.empleados.show',
                $entregaUniforme->empleado_id
            )
            ->with(
                'success',
                'Devolución registrada correctamente.'
            );
    }
}