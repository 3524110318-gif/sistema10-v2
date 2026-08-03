<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'devolucion_uniformes',
            function (Blueprint $table) {

                $table->id();

                $table->foreignId(
                    'entrega_uniforme_id'
                )
                    ->constrained(
                        'entrega_uniformes'
                    )
                    ->cascadeOnUpdate()
                    ->restrictOnDelete();

                $table->foreignId(
                    'empleado_id'
                )
                    ->constrained(
                        'empleados'
                    )
                    ->cascadeOnUpdate()
                    ->restrictOnDelete();

                $table->foreignId(
                    'producto_id'
                )
                    ->constrained(
                        'productos'
                    )
                    ->cascadeOnUpdate()
                    ->restrictOnDelete();

                $table->unsignedInteger(
                    'cantidad'
                );

                $table->date(
                    'fecha_devolucion'
                );

                $table->enum(
                    'resultado',
                    [
                        'reutilizable',
                        'merma',
                    ]
                );

                $table->text(
                    'observaciones'
                )->nullable();

                $table->foreignId(
                    'user_id'
                )
                    ->nullable()
                    ->constrained(
                        'users'
                    )
                    ->nullOnDelete()
                    ->cascadeOnUpdate();

                $table->timestamps();
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'devolucion_uniformes'
        );
    }
};