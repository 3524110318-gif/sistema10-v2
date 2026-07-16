<?php

namespace App\Models\Operaciones;

use Illuminate\Database\Eloquent\Model;
use App\Models\Operaciones\Vehiculo;

class MantenimientoVehicular extends Model
{
    protected $fillable = [

        'vehiculo_id',

        'fecha',

        'kilometraje',

        'tipo',

        'observaciones',

        'proximo_mantenimiento',

    ];

    public function vehiculo()
    {
        return $this->belongsTo(
            Vehiculo::class,
            'vehiculo_id'
        );
    }
}
