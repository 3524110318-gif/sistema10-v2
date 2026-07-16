<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Administracion\Producto;

class CategoriaProducto extends Model
{
    /**
     * Nombre de la tabla.
     */
    protected $table = 'categorias_productos';

    /**
     * Campos asignables.
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];

    /**
     * Conversión automática de atributos.
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Una categoría tiene muchos productos.
     */
    public function productos(): HasMany
    {
        return $this->hasMany(
            Producto::class,
            'categoria_producto_id'
        );
    }
}
