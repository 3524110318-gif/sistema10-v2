<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Model;

class BajaEmpleado extends Model
{
    protected $table = 'bajas_empleados';

    protected $fillable = [

        'empleado_id',

        'fecha_baja',

        'uniforme_devuelto',

        'botas_devueltas',

        'credencial_devuelta',

        'radio_devuelto',

        'carta_renuncia',

        'finiquito_entregado',

        'observaciones',

    ];

    public function empleado()
    {
        return $this->belongsTo(
            Empleado::class
        );
    }
}
