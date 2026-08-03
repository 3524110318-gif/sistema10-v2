<?php

namespace App\Models\RH;

use App\Models\Administracion\Producto;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class DevolucionUniforme extends Model
{
    protected $table = 'devolucion_uniformes';

    protected $fillable = [
        'entrega_uniforme_id',
        'empleado_id',
        'producto_id',
        'cantidad',
        'fecha_devolucion',
        'resultado',
        'observaciones',
        'user_id',
    ];

    protected $casts = [
        'fecha_devolucion' => 'date',
        'cantidad' => 'integer',
    ];

    public function entregaUniforme()
    {
        return $this->belongsTo(
            EntregaUniforme::class
        );
    }

    public function empleado()
    {
        return $this->belongsTo(
            Empleado::class
        );
    }

    public function producto()
    {
        return $this->belongsTo(
            Producto::class
        );
    }

    public function usuario()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}