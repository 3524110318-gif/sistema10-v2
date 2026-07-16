<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use App\Models\Administracion\Factura;

class Cobranza extends Model
{
    protected $table = 'cobranzas';

    protected $fillable = [

        'factura_id',

        'fecha_vencimiento',

        'fecha_pago',

        'monto',

        'estado',

        'referencia_pago',

        'observaciones',

    ];

    protected $casts = [

        'fecha_vencimiento' => 'date',

        'fecha_pago' => 'date',

        'monto' => 'decimal:2',

    ];

    public function factura()
    {
        return $this->belongsTo(
            Factura::class
        );
    }

    public function getSemaforoAttribute()
    {

        if ($this->estado === 'pagada') {

            return 'verde';

        }

        if ($this->estado === 'revision') {

            return 'amarillo';

        }

        if (

            $this->estado === 'vencida'

            ||

            (
                $this->estado === 'pendiente'

                &&

                $this->fecha_vencimiento

                &&

                $this->fecha_vencimiento->isPast()
            )

        ) {

            return 'rojo';

        }

        return 'azul';

    }
}
