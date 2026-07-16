<?php

namespace App\Models\Administracion;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Administracion\DetalleCompra;

class Compra extends Model
{
    protected $table = 'compras';

    protected $fillable = [
        'proveedor_id',
        'folio',
        'fecha_compra',
        'subtotal',
        'iva',
        'total',
        'estado',
        'observaciones',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'fecha_compra' => 'date',
            'subtotal' => 'decimal:2',
            'iva' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    /**
     * La compra pertenece a un proveedor.
     */
    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(
            Proveedor::class
        );
    }

    /**
     * La compra fue registrada por un usuario.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(
            User::class
        );
    }

    /**
     * Una compra tiene muchos detalles.
     */
    public function detalles(): HasMany
    {
        return $this->hasMany(
            DetalleCompra::class
        );
    }
}
