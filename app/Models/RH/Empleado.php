<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Model;
use App\Models\RH\Documento;
use Carbon\Carbon;
use App\Models\RH\Vacacion;
use App\Models\RH\Incidencia;
use App\Models\RH\EntregaUniforme;
use App\Models\RH\Vigencia;
use App\Models\RH\Capacitacion;
use App\Models\RH\BajaEmpleado;
use App\Models\Repse;


class Empleado extends Model
{
    protected $table = 'empleados';
    protected $fillable = [
        'numero_control',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'curp',
        'rfc',
        'nss',
        'telefono',
        'correo',
        'tipo_sangre',
        'puesto',
        'rango',
        'salario_base',
        'fecha_nacimiento',
        'fecha_ingreso',
        'estado',
        'direccion',
        'contacto_emergencia',
        'telefono_emergencia',
        'foto',
    ];
    const DOCUMENTOS_RH = [
        'INE',
        'CURP',
        'RFC',
        'NSS',
        'Comprobante domicilio',
        'Acta nacimiento',
        'Contrato laboral',
        'Certificado médico',
    ];

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    public function antiguedad()
    {

        if (!$this->fecha_ingreso) {
            return 'Sin fecha ingreso';
        }

        $fechaIngreso = Carbon::parse(
            $this->fecha_ingreso
        );

        $hoy = now();

        $años = (int) $fechaIngreso

            ->diffInYears($hoy);

        $meses = (int) $fechaIngreso
            ->copy()
            ->addYears($años)
            ->diffInMonths($hoy);

        $dias = (int) $fechaIngreso
            ->copy()
            ->addYears($años)
            ->addMonths($meses)
            ->diffInDays($hoy);

        return
            $años . ' años, ' .
            $meses . ' meses y ' .
            $dias . ' días';

    }

    public function vacacionesEmpleado()
    {
        return $this->hasMany(Vacacion::class);
    }

    public function vacaciones()
    {
        if (!$this->fecha_ingreso) {
            return 0;
        }

        $años = Carbon::parse(
            $this->fecha_ingreso
        )->diffInYears(now());

        if ($años < 1) {
            return 0;
        }

        $tabla = [
            1 => 12,
            2 => 14,
            3 => 16,
            4 => 18,
            5 => 20,
        ];
        return $tabla[$años] ?? 22;
    }

    public function vacacionesTomadas()
    {
        return $this->vacacionesEmpleado()
        ->where('estado','aprobada')
        ->sum('dias');
    }

    public function vacacionesRestantes()
    {
        return $this->vacaciones()
        - $this->vacacionesTomadas();
    }

    public function incidencias()
    {
        return $this->hasMany(Incidencia::class);
    }

    public function uniformes()
    {
        return $this->hasMany(
            EntregaUniforme::class
        );
    }

    public function vigencias()
    {
        return $this->hasMany(
            Vigencia::class
        );
    }

    public function capacitaciones()
    {
        return $this->hasMany(
            Capacitacion::class
        );
    }

    public function baja()
    {
        return $this->hasOne(
            BajaEmpleado::class
        );
    }

    public function asignaciones()
    {
        return $this->hasMany(
            \App\Models\Operaciones\Asignacion::class,
            'empleado_id'
        );
    }

    public function prenominaDetalles()
    {
        return $this->hasMany(
            \App\Models\Administracion\PrenominaDetalle::class,
            'empleado_id'
        );
    }

    public function repse()
    {
        return $this->hasOne(Repse::class, 'empleado_id');
    }

    public function getNombreCompletoAttribute(): string
    {
        return trim(
            $this->nombre .
            ' ' .
            ($this->apellido_paterno ?? '') .
            ' ' .
            ($this->apellido_materno ?? '')
        );
    }
}
