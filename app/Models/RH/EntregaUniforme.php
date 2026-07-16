<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Model;

class EntregaUniforme extends Model
{
    protected $table = 'entrega_uniformes';

    protected $fillable = [

        'empleado_id',

        'articulo',

        'tipo',

        'fecha_entrega',

        'observaciones',

    ];

    public function empleado()
    {
        return $this->belongsTo(
            Empleado::class
        );
    }
}
