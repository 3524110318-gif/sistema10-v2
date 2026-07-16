<?php

namespace App\Models\Operaciones;

use Illuminate\Database\Eloquent\Model;

class IncidenciaOperativa extends Model
{
    protected $fillable = [

        'servicio_id',

        'supervision_id',

        'tipo',

        'descripcion',

        'folio_fisico',

        'estado',

    ];

    public function servicio()
    {
        return $this->belongsTo(
            Servicio::class,
            'servicio_id'
        );
    }

    public function supervision()
    {
        return $this->belongsTo(
            Supervision::class,
            'supervision_id'
        );
    }

    public function cerrar(IncidenciaOperativa $incidencia)
    {
        $incidencia->update([

            'estado' => 'cerrada'

        ]);

        return redirect()
            ->route(
                'operaciones.incidencias.index'
            );
    }
}
