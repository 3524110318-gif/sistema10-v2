<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Operaciones\Cliente;
use App\Models\Operaciones\Contrato;
use App\Models\Administracion\Cobranza;
use Illuminate\Database\Eloquent\Relations\HasOne;



class Factura extends Model
{
    /**
     * Nombre de la tabla.
     */
    protected $table = 'facturas';

    /**
     * Campos asignables.
     */
    protected $fillable = [

        'cliente_id',

        'contrato_id',

        'folio',

        'fecha_factura',

        'periodo_inicio',

        'periodo_fin',

        'subtotal',

        'iva',

        'total',

        'estado',

        'observaciones',

    ];

    /**
     * Conversión automática de atributos.
     */
    protected function casts(): array
    {
        return [

            'fecha_factura' => 'date',

            'periodo_inicio' => 'date',

            'periodo_fin' => 'date',

            'subtotal' => 'decimal:2',

            'iva' => 'decimal:2',

            'total' => 'decimal:2',

            'created_at' => 'datetime',

            'updated_at' => 'datetime',

        ];
    }

    /**
     * La factura pertenece a un cliente.
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(
            Cliente::class
        );
    }

    /**
     * La factura pertenece a un contrato.
     */
    public function contrato(): BelongsTo
    {
        return $this->belongsTo(
            Contrato::class
        );
    }

    /**
     * Una factura tiene muchos detalles.
     */
    public function detalles(): HasMany
    {
        return $this->hasMany(
            DetalleFactura::class
        );
    }

    public function cobranza(): HasOne
    {
        return $this->hasOne(
            Cobranza::class
        );
    }
}
