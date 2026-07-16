<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedor extends Model
{
    /**
     * Nombre de la tabla.
     */
    protected $table = 'proveedores';

    /**
     * Campos asignables.
     */
    protected $fillable = [
        'razon_social',
        'rfc',
        'nombre_contacto',
        'telefono',
        'correo',
        'direccion',
        'ciudad',
        'codigo_postal',
        'estado',
        'observaciones',
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
     * Compras del proveedor.
     */
    public function compras(): HasMany
    {
        return $this->hasMany(
            Compra::class
        );
    }
}
