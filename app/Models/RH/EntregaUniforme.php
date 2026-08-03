<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Administracion\Producto;
use App\Models\RH\DevolucionUniforme;

class EntregaUniforme extends Model
{
    protected $table = 'entrega_uniformes';

    protected $fillable = [
        'empleado_id',
        'producto_id',
        'cantidad',
        'articulo',
        'tipo',
        'fecha_entrega',
        'observaciones',
        'firma_path',
        'pdf_resguardo',
        'prenomina_detalle_id',
        'deduccion_aplicada_at',
    ];

    protected $casts = [
        'fecha_entrega' => 'date',
        'cantidad' => 'integer',
        'deduccion_aplicada_at' => 'datetime',
    ];

    public function empleado(): BelongsTo
    {
        return $this->belongsTo(
            Empleado::class
        );
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(
            Producto::class
        );
    }

    public function devoluciones()
    {
        return $this->hasMany(
            DevolucionUniforme::class
        );
    }

    public function prenominaDetalle()
    {
        return $this->belongsTo(
            \App\Models\Administracion\PrenominaDetalle::class,
            'prenomina_detalle_id'
        );
    }
}