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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\ActividadService;


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

                'firma' => [
                    'required',
                    'string',
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

                'firma.required' =>
                    'La firma del empleado es obligatoria.',

                'firma.string' =>
                    'La firma recibida no es válida.',
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

        $firmaPath = null;

        try {

            DB::transaction(function () use (
                $datos,
                $empleado,
                $producto,
                &$firmaPath
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

                /*
                |--------------------------------------------------------------------------
                | GUARDAR FIRMA DEL EMPLEADO
                |--------------------------------------------------------------------------
                */

                $firmaPath = null;

                if (!empty($datos['firma'])) {

                    $firma = preg_replace(
                        '#^data:image/\w+;base64,#i',
                        '',
                        $datos['firma']
                    );

                    $firma = str_replace(' ', '+', $firma);

                    $imagen = base64_decode($firma);

                    if ($imagen === false) {
                        throw new \RuntimeException(
                            'No fue posible procesar la firma del empleado.'
                        );
                    }

                    $nombreFirma =
                        'firma_' .
                        Str::uuid() .
                        '.png';

                    $firmaPath =
                        'firmas_uniformes/' .
                        $nombreFirma;

                    Storage::disk('public')->put(
                        $firmaPath,
                        $imagen
                    );

                }

                $entrega = EntregaUniforme::create([
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
                    'firma_path' => $firmaPath,
                ]);

                $pdfPath =
                    $this->generarPdfResguardo(
                        $entrega
                    );

                $entrega->update([
                    'pdf_resguardo' =>
                        $pdfPath,
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

                ActividadService::registrar(

                    'Registró la entrega de '
                    . $datos['cantidad']
                    . ' unidad(es) de "'
                    . $productoBloqueado->nombre
                    . '" para el empleado '
                    . $empleado->numero_control,

                    null,

                    [

                        'empleado_id' =>
                            $empleado->id,

                        'numero_control' =>
                            $empleado->numero_control,

                        'producto_id' =>
                            $productoBloqueado->id,

                        'producto' =>
                            $productoBloqueado->nombre,

                        'cantidad' =>
                            $datos['cantidad'],

                        'tipo_movimiento' =>
                            'entrega',

                    ]

                );

            });
        } catch (\Throwable $e) {

            if (
                isset($firmaPath) &&
                $firmaPath &&
                Storage::disk('public')->exists($firmaPath)
            ) {
                Storage::disk('public')->delete($firmaPath);
            }

            throw $e;
        }

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

    private function generarPdfResguardo(
        EntregaUniforme $entrega
    ): string {

        $entrega->load([
            'empleado',
            'producto',
        ]);

        $usuario = Auth::user();

        $usuarioRegistro =
            $usuario?->name
            ?? $usuario?->rol
            ?? 'Usuario del sistema';

        $nombrePdf =
            'resguardo_uniforme_' .
            str_pad(
                $entrega->id,
                6,
                '0',
                STR_PAD_LEFT
            ) .
            '.pdf';

        $rutaPdf =
            'resguardos_uniformes/' .
            $nombrePdf;

        $pdf = Pdf::loadView(
            'rh.uniformes.pdf.resguardo',
            compact(
                'entrega',
                'usuarioRegistro'
            )
        );

        $pdf->setPaper(
            'letter',
            'portrait'
        );

        $guardado = Storage::disk('public')->put(
            $rutaPdf,
            $pdf->output()
        );

        if (!$guardado) {
            throw new \RuntimeException(
                'No fue posible guardar el PDF de resguardo.'
            );
        }

        return $rutaPdf;
    }
}