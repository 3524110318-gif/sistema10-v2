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
            'activos',
            function (Blueprint $table)
            {
                $table->id();

                $table->foreignId(
                    'producto_id'
                )
                ->constrained(
                    'productos'
                )
                ->cascadeOnUpdate()
                ->restrictOnDelete();

                $table->string(
                    'codigo_activo'
                )->unique();

                $table->string(
                    'numero_serie'
                )->nullable();

                $table->string(
                    'marca'
                )->nullable();

                $table->string(
                    'modelo'
                )->nullable();

                $table->date(
                    'fecha_adquisicion'
                )->nullable();

                $table->decimal(
                    'valor',
                    10,
                    2
                )->default(0);

                $table->enum(
                    'estado',
                    [
                        'disponible',
                        'asignado',
                        'mantenimiento',
                        'baja'
                    ]
                )->default(
                    'disponible'
                );

                $table->text(
                    'observaciones'
                )->nullable();

                $table->string('ubicacion_actual')
                    ->nullable();

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
            'activos'
        );
    }
};
