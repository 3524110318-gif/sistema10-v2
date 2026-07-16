<?php

namespace App\Models\Operaciones;

use Illuminate\Database\Eloquent\Model;
use App\Models\Operaciones\MantenimientoVehicular;

class Vehiculo extends Model
{
    protected $fillable = [

        'unidad',

        'placas',

        'marca',

        'modelo',

        'anio',

        'kilometraje_actual',

        'estado',

    ];

    public function mantenimientos()
    {
        return $this->hasMany(
            MantenimientoVehicular::class,
            'vehiculo_id'
        );
    }
}
