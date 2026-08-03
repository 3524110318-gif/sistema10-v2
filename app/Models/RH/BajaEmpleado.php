<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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

        'archivo_carta_renuncia',

        'finiquito_entregado',

        'archivo_finiquito',

        'observaciones',

        'user_id',

    ];

    protected $casts = [

        'fecha_baja' => 'date',

        'uniforme_devuelto' => 'boolean',

        'botas_devueltas' => 'boolean',

        'credencial_devuelta' => 'boolean',

        'radio_devuelto' => 'boolean',

        'carta_renuncia' => 'boolean',

        'finiquito_entregado' => 'boolean',

    ];

    public function empleado()
    {
        return $this->belongsTo(
            Empleado::class
        );
    }

    public function usuario()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}