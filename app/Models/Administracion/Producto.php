<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\RH\EntregaUniforme;

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
        'stock_maximo',
        'precio_compra',
        'precio_promedio',
        'estado',
        'tipo_producto',
        'genera_deduccion',
        'monto_deduccion',
    ];

    /**
     * Conversión de atributos.
     */
    protected function casts(): array
    {
        return [
            'precio_compra' => 'decimal:2',
            'precio_promedio' => 'decimal:2',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'genera_deduccion' => 'boolean',
            'monto_deduccion' => 'decimal:2',
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

    /**
     * Entregas de uniforme relacionadas con el producto.
     */
    public function entregasUniforme(): HasMany
    {
        return $this->hasMany(
            EntregaUniforme::class,
            'producto_id'
        );
    }
}
