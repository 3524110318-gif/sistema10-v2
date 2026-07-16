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
        Schema::create(
            'asignaciones_activos',
            function (Blueprint $table)
            {
                $table->id();

                $table->foreignId(
                    'activo_id'
                )
                ->constrained(
                    'activos'
                )
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

                $table->foreignId(
                    'empleado_id'
                )
                ->constrained(
                    'empleados'
                )
                ->cascadeOnUpdate()
                ->restrictOnDelete();

                $table->foreignId(
                    'servicio_id'
                )
                ->nullable()
                ->constrained(
                    'servicios'
                )
                ->nullOnDelete();

                $table->date(
                    'fecha_entrega'
                );

                $table->date(
                    'fecha_devolucion'
                )->nullable();

                $table->enum(
                    'estado',
                    [
                        'activa',
                        'devuelta'
                    ]
                )->default(
                    'activa'
                );

                $table->text(
                    'observaciones'
                )->nullable();

                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'asignaciones_activos'
        );
    }
};
