<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activo extends Model
{
    /**
     * Nombre de la tabla.
     */
    protected $table = 'activos';

    /**
     * Campos asignables.
     */
    protected $fillable = [

        'producto_id',

        'codigo_activo',

        'numero_serie',

        'marca',

        'modelo',

        'fecha_adquisicion',

        'valor',

        'estado',

        'observaciones',

    ];

    /**
     * Conversión de atributos.
     */
    protected function casts(): array
    {
        return [

            'fecha_adquisicion' => 'date',

            'valor' => 'decimal:2',

            'created_at' => 'datetime',

            'updated_at' => 'datetime',

        ];
    }

    /**
     * Un activo pertenece a un producto.
     */
    public function producto(): BelongsTo
    {
        return $this->belongsTo(
            Producto::class
        );
    }
}
