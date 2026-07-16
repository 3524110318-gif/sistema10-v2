<?php

namespace App\Models\Administracion;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovimientoInventario extends Model
{
    /**
     * Nombre de la tabla.
     */
    protected $table = 'movimientos_inventario';

    /**
     * Campos asignables.
     */
    protected $fillable = [
        'producto_id',
        'tipo_movimiento',
        'cantidad',
        'stock_anterior',
        'stock_nuevo',
        'fecha_movimiento',
        'user_id',
        'referencia',
        'motivo',
        'observaciones',
        'origen',
    ];

    /**
     * Conversión de atributos.
     */
    protected function casts(): array
    {
        return [
            'fecha_movimiento' => 'datetime',
        ];
    }

    /**
     * El movimiento pertenece a un producto.
     */
    public function producto(): BelongsTo
    {
        return $this->belongsTo(
            Producto::class
        );
    }

    /**
     * Usuario que realizó el movimiento.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}
