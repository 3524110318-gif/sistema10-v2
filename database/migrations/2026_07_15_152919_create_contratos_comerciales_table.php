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
        Schema::create('contratos_comerciales', function (Blueprint $table) {
            $table->id();

            $table->foreignId(
                'cliente_comercial_id'
            )
            ->constrained(
                'clientes_comerciales'
            )
            ->cascadeOnUpdate()
            ->restrictOnDelete();

            $table->string(
                'folio'
            )->unique();

            $table->date(
                'fecha_inicio'
            );

            $table->date(
                'fecha_fin'
            );

            $table->decimal(
                'tarifa',
                12,
                2
            );

            $table->integer(
                'numero_plazas'
            );

            $table->decimal(
                'indexacion_anual',
                5,
                2
            )->default(0);

            $table->string(
                'pdf_consignas'
            )->nullable();

            $table->boolean(
                'anticipo_validado'
            )->default(false);

            $table->enum(
                'estado',
                [
                    'borrador',
                    'pendiente',
                    'activo',
                    'finalizado',
                    'cancelado'
                ]
            )->default(
                'borrador'
            );

            $table->text(
                'observaciones'
            )->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos_comerciales');
    }
};
