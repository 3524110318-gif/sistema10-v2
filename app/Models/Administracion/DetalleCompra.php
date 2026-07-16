<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleCompra extends Model
{
    /**
     * Nombre de la tabla.
     */
    protected $table = 'detalle_compras';

    /**
     * Campos asignables.
     */
    protected $fillable = [
        'compra_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    /**
     * Conversión de atributos.
     */
    protected function casts(): array
    {
        return [
            'precio_unitario' => 'decimal:2',
            'subtotal' => 'decimal:2',
        ];
    }

    /**
     * El detalle pertenece a una compra.
     */
    public function compra(): BelongsTo
    {
        return $this->belongsTo(
            Compra::class
        );
    }

    /**
     * El detalle pertenece a un producto.
     */
    public function producto(): BelongsTo
    {
        return $this->belongsTo(
            Producto::class
        );
    }
}
