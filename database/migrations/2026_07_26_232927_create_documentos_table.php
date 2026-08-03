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
        Schema::create('documentos', function (Blueprint $table) {

            $table->id();

            $table->foreignId('empleado_id')
                ->constrained('empleados')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('nombre', 150);

            $table->boolean('entregado')
                ->default(false);

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | EVITAR DOCUMENTOS DUPLICADOS
            |--------------------------------------------------------------------------
            |
            | Un empleado solamente puede tener una vez cada documento.
            |
            */

            $table->unique(
                [
                    'empleado_id',
                    'nombre',
                ],
                'documentos_empleado_nombre_unique'
            );

        });
    }

    /**
     * Revertir la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};