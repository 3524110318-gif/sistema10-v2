<?php

namespace App\Models\Administracion;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogActividad extends Model
{
    /**
     * Nombre real de la tabla.
     */
    protected $table = 'log_actividads';

    /**
     * Campos asignables.
     */
    protected $fillable = [

        'user_id',

        'usuario',

        'rol',

        'accion',

        'valor_anterior',

        'valor_nuevo',

        'ip',

        'user_agent',

    ];

    /**
     * Conversión automática.
     */
    protected function casts(): array
    {
        return [

            'valor_anterior' => 'array',

            'valor_nuevo' => 'array',

            'created_at' => 'datetime',

            'updated_at' => 'datetime',

        ];
    }

    /**
     * Usuario que realizó la acción.
     */
    public function usuarioSistema(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}