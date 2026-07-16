<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Administracion\Activo;
use App\Models\RH\Empleado;
use App\Models\Operaciones\Servicio;

class AsignacionActivo extends Model
{
    /**
     * Nombre de la tabla.
     */
    protected $table = 'asignaciones_activos';

    /**
     * Campos asignables.
     */
    protected $fillable = [

        'activo_id',

        'empleado_id',

        'servicio_id',

        'fecha_entrega',

        'fecha_devolucion',

        'estado',

        'observaciones',

    ];

    /**
     * Conversión automática de atributos.
     */
    protected function casts(): array
    {
        return [

            'fecha_entrega' => 'date',

            'fecha_devolucion' => 'date',

            'created_at' => 'datetime',

            'updated_at' => 'datetime',

        ];
    }

    /**
     * La asignación pertenece a un activo.
     */
    public function activo(): BelongsTo
    {
        return $this->belongsTo(
            Activo::class
        );
    }

    /**
     * La asignación pertenece a un empleado.
     */
    public function empleado(): BelongsTo
    {
        return $this->belongsTo(
            Empleado::class
        );
    }

    /**
     * La asignación pertenece a un servicio.
     */
    public function servicio(): BelongsTo
    {
        return $this->belongsTo(
            Servicio::class
        );
    }
}
