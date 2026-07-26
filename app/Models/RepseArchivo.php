<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RH\Empleado;
use App\Models\Operaciones\Cliente;

class RepseArchivo extends Model
{
    protected $fillable = [

        'empleado_id',
        'cliente_id',
        'periodo',
        'tipo',
        'archivo',

    ];

    public function empleado()
    {
        return $this->belongsTo(
            Empleado::class,
            'empleado_id'
        );
    }

    public function cliente()
    {
        return $this->belongsTo(
            Cliente::class,
            'cliente_id'
        );
    }

    public function getTipoNombreAttribute(): string
    {
        return match ($this->tipo) {

            'alta_imss' => 'Alta IMSS',

            'nomina_pdf' => 'Nómina PDF',

            'nomina_xml' => 'Nómina XML',

            'constancia_sat' => 'Constancia SAT',

            'pago_sua' => 'Pago SUA',

            default => ucfirst(
                str_replace(
                    '_',
                    ' ',
                    $this->tipo
                )
            ),

        };
    }
}