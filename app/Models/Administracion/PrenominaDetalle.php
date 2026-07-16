<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use App\Models\Administracion\Prenomina;
use App\Models\RH\Empleado;

class PrenominaDetalle extends Model
{
    protected $table = 'prenomina_detalles';

    protected $fillable = [

        'prenomina_id',

        'empleado_id',

        'salario_base',

        'dias_laborados',

        'dias_incapacidad',

        'folio_imss',

        'percepciones',

        'deducciones',

        'ajustes',

        'justificacion',

        'total_neto',

        'horas_extra',

    ];

    protected $casts = [

        'salario_base' => 'decimal:2',

        'percepciones' => 'decimal:2',

        'deducciones' => 'decimal:2',

        'ajustes' => 'decimal:2',

        'total_neto' => 'decimal:2',

        'horas_extra' => 'decimal:2',

    ];

    public function prenomina()
    {
        return $this->belongsTo(
            Prenomina::class
        );
    }

    public function empleado()
    {
        return $this->belongsTo(
            Empleado::class
        );
    }

    public function calcularTotal()
    {
        return

            $this->salario_base

            +

            $this->percepciones

            +

            $this->horas_extra

            +

            $this->ajustes

            -

            $this->deducciones;

    }
}
