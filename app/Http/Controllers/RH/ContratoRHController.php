<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\RH\ContratoRH;
use App\Models\RH\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Services\ActividadService;

class ContratoRHController extends Controller
{
    /**
     * Mostrar contratos laborales.
     */
    public function index(Request $request)
    {
        $this->actualizarContratosVencidos();

        $contratos = ContratoRH::with('empleado')
            ->when(
                $request->filled('buscar'),
                function ($query) use ($request) {

                    $buscar = $request->buscar;

                    $query->where(function ($consulta) use ($buscar) {

                        $consulta->where(
                            'numero_contrato',
                            'like',
                            "%{$buscar}%"
                        )
                        ->orWhereHas(
                            'empleado',
                            function ($empleado) use ($buscar) {

                                $empleado->where(
                                    'numero_control',
                                    'like',
                                    "%{$buscar}%"
                                )
                                ->orWhere(
                                    'nombre',
                                    'like',
                                    "%{$buscar}%"
                                )
                                ->orWhere(
                                    'apellido_paterno',
                                    'like',
                                    "%{$buscar}%"
                                )
                                ->orWhere(
                                    'apellido_materno',
                                    'like',
                                    "%{$buscar}%"
                                );

                            }
                        );

                    });

                }
            )
            ->orderByDesc('fecha_inicio')
            ->paginate(10)
            ->withQueryString();

        return view(
            'rh.contratos.index',
            compact('contratos')
        );
    }

    /**
     * Mostrar formulario para registrar contrato.
     */
    public function create()
    {
        $empleados = Empleado::whereIn(
            'estado',
            [
                'pendiente',
                'activo',
            ]
        )
            ->whereDoesntHave(
                'contratosRH',
                function ($query) {

                    $query->where(
                        'estado',
                        'vigente'
                    );

                }
            )
            ->orderBy('nombre')
            ->orderBy('apellido_paterno')
            ->get();

        return view(
            'rh.contratos.create',
            compact('empleados')
        );
    }

    /**
     * Registrar contrato laboral.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'empleado_id' => [
                'required',
                'exists:empleados,id',
            ],

            'numero_contrato' => [
                'required',
                'string',
                'max:100',
                'unique:contratos_rh,numero_contrato',
            ],

            'tipo_contrato' => [
                'required',
                Rule::in([
                    'indeterminado',
                    'determinado',
                    'eventual',
                    'prueba',
                ]),
            ],

            'fecha_inicio' => [
                'required',
                'date',
            ],

            'fecha_fin' => [
                'nullable',
                'date',
                'after_or_equal:fecha_inicio',
            ],

            'fecha_firma' => [
                'nullable',
                'date',
            ],

            'firmado' => [
                'nullable',
                'boolean',
            ],

            'observaciones' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $tieneContratoVigente = ContratoRH::where(
            'empleado_id',
            $datos['empleado_id']
        )
            ->where(
                'estado',
                'vigente'
            )
            ->exists();

        if ($tieneContratoVigente) {

            return back()
                ->withErrors([
                    'empleado_id' =>
                        'El empleado ya tiene un contrato vigente.',
                ])
                ->withInput();

        }

        if (
            $datos['tipo_contrato'] !== 'indeterminado'
            && empty($datos['fecha_fin'])
        ) {
            return back()
                ->withErrors([
                    'fecha_fin' =>
                        'La fecha de término es obligatoria para este tipo de contrato.',
                ])
                ->withInput();
        }

        $datos['firmado'] = $request->boolean('firmado');

        if (!$datos['firmado']) {
            $datos['fecha_firma'] = null;
        }

        $datos['estado'] = $this->determinarEstado(
            $datos['fecha_inicio'],
            $datos['fecha_fin'] ?? null
        );

        $contrato = ContratoRH::create($datos);

        $empleado = Empleado::findOrFail(
            $datos['empleado_id']
        );

        ActividadService::registrar(

            'Registró el contrato laboral '
            . $contrato->numero_contrato
            . ' para el empleado '
            . $empleado->numero_control
            . ' - '
            . $empleado->nombre
            . ' '
            . $empleado->apellido_paterno,

            null,

            [

                'id' => $contrato->id,

                'empleado_id' =>
                    $empleado->id,

                'numero_control' =>
                    $empleado->numero_control,

                'numero_contrato' =>
                    $contrato->numero_contrato,

                'tipo_contrato' =>
                    $contrato->tipo_contrato,

                'estado' =>
                    $contrato->estado,

                'fecha_inicio' =>
                    $contrato->fecha_inicio,

                'fecha_fin' =>
                    $contrato->fecha_fin,

            ]

        );

        return redirect()
            ->route('rh.contratos.index')
            ->with(
                'success',
                'Contrato laboral registrado correctamente.'
            );
    }

    /**
     * Consultar contrato.
     */
    public function show(ContratoRH $contrato)
    {
        $this->actualizarContrato($contrato);

        $contrato->load('empleado');

        return view(
            'rh.contratos.show',
            compact('contrato')
        );
    }

    /**
     * Mostrar formulario de renovación.
     */
    public function renovar(ContratoRH $contrato)
    {
        $contrato->load('empleado');

        return view(
            'rh.contratos.renovar',
            compact('contrato')
        );
    }

    /**
     * Guardar renovación conservando el historial.
     */
    public function guardarRenovacion(
        Request $request,
        ContratoRH $contrato
    ) {
        $datos = $request->validate([
            'numero_contrato' => [
                'required',
                'string',
                'max:100',
                'unique:contratos_rh,numero_contrato',
            ],

            'tipo_contrato' => [
                'required',
                Rule::in([
                    'indeterminado',
                    'determinado',
                    'eventual',
                    'prueba',
                ]),
            ],

            'fecha_inicio' => [
                'required',
                'date',
            ],

            'fecha_fin' => [
                'nullable',
                'date',
                'after_or_equal:fecha_inicio',
            ],

            'fecha_firma' => [
                'nullable',
                'date',
            ],

            'firmado' => [
                'nullable',
                'boolean',
            ],

            'observaciones' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        if (
            $datos['tipo_contrato'] !== 'indeterminado'
            && empty($datos['fecha_fin'])
        ) {
            return back()
                ->withErrors([
                    'fecha_fin' =>
                        'La fecha de término es obligatoria para este tipo de contrato.',
                ])
                ->withInput();
        }

        $datos['firmado'] = $request->boolean('firmado');

        if (!$datos['firmado']) {
            $datos['fecha_firma'] = null;
        }

        $datos['empleado_id'] = $contrato->empleado_id;

        $datos['estado'] = $this->determinarEstado(
            $datos['fecha_inicio'],
            $datos['fecha_fin'] ?? null
        );

        DB::transaction(function () use (
            $contrato,
            $datos
        ) {
            $contrato->update([
                'estado' => 'vencido',
            ]);

            ContratoRH::create($datos);
        });

        return redirect()
            ->route('rh.contratos.index')
            ->with(
                'success',
                'Contrato renovado correctamente.'
            );
    }

    /**
     * Cancelar contrato sin eliminar el historial.
     */
    public function cancelar(ContratoRH $contrato)
    {
        if ($contrato->estado === 'cancelado') {
            return back()->with(
                'error',
                'El contrato ya se encuentra cancelado.'
            );
        }

        $contrato->update([
            'estado' => 'cancelado',
        ]);

        return redirect()
            ->route('rh.contratos.index')
            ->with(
                'success',
                'Contrato cancelado correctamente.'
            );
    }

    /**
     * Determinar la vigencia del contrato.
     */
    private function determinarEstado(
        string $fechaInicio,
        ?string $fechaFin
    ): string {
        if (
            $fechaFin
            && now()->startOfDay()->greaterThan(
                \Carbon\Carbon::parse($fechaFin)->startOfDay()
            )
        ) {
            return 'vencido';
        }

        return 'vigente';
    }

    /**
     * Actualizar contratos vencidos automáticamente.
     */
    private function actualizarContratosVencidos(): void
    {
        ContratoRH::where('estado', 'vigente')
            ->whereNotNull('fecha_fin')
            ->whereDate('fecha_fin', '<', now()->toDateString())
            ->update([
                'estado' => 'vencido',
            ]);
    }

    /**
     * Actualizar la vigencia de un contrato.
     */
    private function actualizarContrato(
        ContratoRH $contrato
    ): void {
        if (
            $contrato->estado === 'vigente'
            && $contrato->fecha_fin
            && $contrato->fecha_fin->isPast()
        ) {
            $contrato->update([
                'estado' => 'vencido',
            ]);

            $contrato->refresh();
        }
    }
}