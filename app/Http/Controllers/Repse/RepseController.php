<?php

namespace App\Http\Controllers\Repse;

use App\Http\Controllers\Controller;
use App\Models\Repse;
use App\Models\RH\Empleado;
use Illuminate\Http\Request;

class RepseController extends Controller
{
    public function index(Request $request)
    {
        $query = Repse::with('empleado');

        if ($request->filled('buscar')) {

            $query->whereHas('empleado', function ($q) use ($request) {

                $q->where('nombre', 'like', '%' . $request->buscar . '%');

            });

        }

        $repses = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('repse.index', [

            'repses' => $repses,

            'total' => Repse::count(),

            'cumplen' => Repse::where('estatus','cumple')->count(),

            'pendientes' => Repse::where('estatus','pendiente')->count(),

            'bloqueados' => Repse::where('estatus','bloqueado')->count(),
            'porVencer' => Repse::whereNotNull('vigencia_cedula_ssp')
                ->whereDate('vigencia_cedula_ssp', '>=', now()->startOfDay())
                ->whereDate('vigencia_cedula_ssp', '<=', now()->copy()->addDays(30))
                ->count(),

        ]);
    }

    public function create()
    {
        $empleados = Empleado::orderBy('nombre')->get();

        return view('repse.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'empleado_id' =>
                'required|exists:empleados,id|unique:repses,empleado_id',

            'vigencia_cedula_ssp' => [
                'nullable',
                'date',
                'required_if:cedula_ssp,1',
            ],

            'rfc_constancia' => [
                'nullable',
                'string',
                'max:13',
                'required_if:constancia_fiscal,1',
            ],

            'observaciones' =>
                'nullable|string',

        ]);

        $data = $request->all();

        $empleado = Empleado::findOrFail(
            $request->empleado_id
        );

        if (
            $request->has('constancia_fiscal') &&
            strtoupper(trim($request->rfc_constancia)) !==
            strtoupper(trim($empleado->rfc))
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'rfc_constancia' =>
                        'El RFC de la constancia fiscal no coincide con el RFC registrado del empleado.'
                ]);
        }

        $data['alta_imss'] = $request->has('alta_imss');
        $data['contrato_firmado'] = $request->has('contrato_firmado');
        $data['cedula_ssp'] = $request->has('cedula_ssp');
        $data['constancia_fiscal'] = $request->has('constancia_fiscal');

        if (
            $data['alta_imss'] &&
            $data['contrato_firmado'] &&
            $data['cedula_ssp'] &&
            $data['constancia_fiscal'] &&
            $request->vigencia_cedula_ssp &&
            \Carbon\Carbon::parse(
                $request->vigencia_cedula_ssp
            )->startOfDay()->gte(
                now()->startOfDay()
            )
        ) {

            $data['estatus'] = 'cumple';

        } elseif (
            !$data['alta_imss'] &&
            !$data['contrato_firmado'] &&
            !$data['cedula_ssp'] &&
            !$data['constancia_fiscal']
        ) {

            $data['estatus'] = 'bloqueado';

        } else {

            $data['estatus'] = 'pendiente';

        }

        Repse::create($data);

        return redirect()
            ->route('expedientes.index')
            ->with('success', 'Expediente REPSE registrado correctamente.');
    }

    public function show(Repse $expediente)
    {
        $expediente->load('empleado');

        return view(
            'repse.show',
            compact('expediente')
        );
    }

    public function edit(Repse $expediente)
    {
        $empleados = Empleado::orderBy('nombre')->get();

        return view(
            'repse.edit',
            compact('expediente', 'empleados')
        );
    }

    public function update(Request $request, Repse $expediente)
    {
        $request->validate([

            'empleado_id' =>
                'required|exists:empleados,id|unique:repses,empleado_id,' . $expediente->id,

            'vigencia_cedula_ssp' => [
                'nullable',
                'date',
                'required_if:cedula_ssp,1',
            ],

            'rfc_constancia' => [
                'nullable',
                'string',
                'max:13',
                'required_if:constancia_fiscal,1',
            ],

            'observaciones' =>
                'nullable|string',

        ]);

        $data = $request->all();

        $empleado = Empleado::findOrFail(
            $request->empleado_id
        );

        if (
            $request->has('constancia_fiscal') &&
            strtoupper(trim($request->rfc_constancia)) !==
            strtoupper(trim($empleado->rfc))
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'rfc_constancia' =>
                        'El RFC de la constancia fiscal no coincide con el RFC registrado del empleado.'
                ]);
        }

        $data['alta_imss'] = $request->has('alta_imss');
        $data['contrato_firmado'] = $request->has('contrato_firmado');
        $data['cedula_ssp'] = $request->has('cedula_ssp');
        $data['constancia_fiscal'] = $request->has('constancia_fiscal');

        if (
            $data['alta_imss'] &&
            $data['contrato_firmado'] &&
            $data['cedula_ssp'] &&
            $data['constancia_fiscal'] &&
            $request->vigencia_cedula_ssp &&
            \Carbon\Carbon::parse(
                $request->vigencia_cedula_ssp
            )->startOfDay()->gte(
                now()->startOfDay()
            )
        ) {

            $data['estatus'] = 'cumple';

        }elseif (
            !$data['alta_imss'] &&
            !$data['contrato_firmado'] &&
            !$data['cedula_ssp'] &&
            !$data['constancia_fiscal']
        ) {

            $data['estatus'] = 'bloqueado';

        } else {

            $data['estatus'] = 'pendiente';

        }
        $expediente->update($data);

        return redirect()
            ->route('expedientes.index')
            ->with('success', 'Expediente actualizado correctamente.');
    }

    public function destroy(Repse $expediente)
    {
        $expediente->delete();

        return redirect()
            ->route('expedientes.index')
            ->with('success', 'Expediente eliminado correctamente.');
    }
}