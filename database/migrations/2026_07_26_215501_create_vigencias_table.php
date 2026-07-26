<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar la migración.
     */
    public function up(): void
    {
        Schema::create('vigencias', function (Blueprint $table) {

            $table->id();

            $table->foreignId('empleado_id')
                ->constrained('empleados')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            /*
             * Nombre final del documento.
             *
             * Cuando el usuario selecciona una opción normal se guarda
             * directamente, por ejemplo: "Examen médico".
             *
             * Cuando selecciona "Otro", aquí se guarda el nombre escrito
             * por el usuario.
             */
            $table->string(
                'documento',
                150
            );

            $table->date(
                'fecha_vencimiento'
            );

            /*
             * Ruta relativa del archivo almacenado en storage/app/public.
             */
            $table->string(
                'evidencia'
            )
                ->nullable();

            $table->timestamps();

            /*
             * Evita registrar exactamente el mismo documento con la misma
             * fecha para el mismo empleado.
             */
            $table->unique(
                [
                    'empleado_id',
                    'documento',
                    'fecha_vencimiento',
                ],
                'vigencias_empleado_documento_fecha_unique'
            );

            $table->index(
                'fecha_vencimiento',
                'vigencias_fecha_vencimiento_index'
            );

        });
    }

    /**
     * Revertir la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'vigencias'
        );
    }
};