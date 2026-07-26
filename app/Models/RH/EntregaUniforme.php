<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Administracion\Producto;

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

    ];

    protected $casts = [
        'fecha_entrega' => 'date',
        'cantidad' => 'integer',
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
}