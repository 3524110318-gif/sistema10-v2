<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Administracion\Factura;
use App\Models\Operaciones\Servicio;

class DetalleFactura extends Model
{
    /**
     * Nombre de la tabla.
     */
    protected $table = 'detalle_facturas';

    /**
     * Campos asignables.
     */
    protected $fillable = [

        'factura_id',

        'servicio_id',

        'plazas_contratadas',

        'plazas_cubiertas',

        'precio_unitario',

        'subtotal',

        'observaciones',

    ];

    /**
     * Conversión automática de atributos.
     */
    protected function casts(): array
    {
        return [

            'precio_unitario' => 'decimal:2',

            'subtotal' => 'decimal:2',

            'created_at' => 'datetime',

            'updated_at' => 'datetime',

        ];
    }

    /**
     * El detalle pertenece a una factura.
     */
    public function factura(): BelongsTo
    {
        return $this->belongsTo(
            Factura::class
        );
    }

    /**
     * El detalle pertenece a un servicio.
     */
    public function servicio(): BelongsTo
    {
        return $this->belongsTo(
            Servicio::class
        );
    }
}
