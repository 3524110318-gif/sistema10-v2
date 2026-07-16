<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    /**
     * Nombre de la tabla.
     */
    protected $table = 'productos';

    /**
     * Campos asignables.
     */
    protected $fillable = [
        'categoria_producto_id',
        'codigo',
        'nombre',
        'descripcion',
        'unidad_medida',
        'stock_actual',
        'stock_minimo',
        'precio_compra',
        'estado',
        'tipo_producto',
    ];

    /**
     * Conversión de atributos.
     */
    protected function casts(): array
    {
        return [
            'precio_compra' => 'decimal:2',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Categoría del producto.
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(
            CategoriaProducto::class,
            'categoria_producto_id'
        );
    }

    /**
     * Movimientos de inventario.
     */
    public function movimientos(): HasMany
    {
        return $this->hasMany(
            MovimientoInventario::class
        );
    }

    /**
     * Detalles de compras.
     */
    public function detalleCompras(): HasMany
    {
        return $this->hasMany(
            DetalleCompra::class
        );
    }

    /**
     * Activos registrados.
     */
    public function activos(): HasMany
    {
        return $this->hasMany(
            Activo::class
        );
    }
}
