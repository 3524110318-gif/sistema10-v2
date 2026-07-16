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
            'detalle_facturas',
            function (Blueprint $table)
            {
                $table->id();

                $table->foreignId(
                    'factura_id'
                )
                ->constrained(
                    'facturas'
                )
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

                $table->foreignId(
                    'servicio_id'
                )
                ->constrained(
                    'servicios'
                )
                ->cascadeOnUpdate()
                ->restrictOnDelete();

                $table->integer(
                    'plazas_contratadas'
                );

                $table->integer(
                    'plazas_cubiertas'
                );

                $table->decimal(
                    'precio_unitario',
                    12,
                    2
                );

                $table->decimal(
                    'subtotal',
                    12,
                    2
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
            'detalle_facturas'
        );
    }
};
