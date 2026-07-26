<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('capacitaciones', function (Blueprint $table) {

            $table->id();

            $table->foreignId('empleado_id')
                ->constrained('empleados')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('curso', 150);

            $table->date('fecha_capacitacion');

            $table->unsignedTinyInteger('calificacion')
                ->nullable();

            $table->date('vigencia_hasta')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | NUEVOS CAMPOS
            |--------------------------------------------------------------------------
            */

            $table->string('evidencia')
                ->nullable()
                ->comment('Ruta del archivo de evidencia');

            $table->string('dc3')
                ->nullable()
                ->comment('Ruta del archivo DC3');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capacitaciones');
    }
};