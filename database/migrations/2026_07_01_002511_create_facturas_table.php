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
            'facturas',
            function (Blueprint $table)
            {
                $table->id();

                $table->foreignId(
                    'cliente_id'
                )
                ->constrained(
                    'clientes'
                )
                ->cascadeOnUpdate()
                ->restrictOnDelete();

                $table->foreignId(
                    'contrato_id'
                )
                ->constrained(
                    'contratos'
                )
                ->cascadeOnUpdate()
                ->restrictOnDelete();

                $table->string(
                    'folio'
                )->unique();

                $table->date(
                    'fecha_factura'
                );

                $table->date(
                    'periodo_inicio'
                );

                $table->date(
                    'periodo_fin'
                );

                $table->decimal(
                    'subtotal',
                    12,
                    2
                )->default(0);

                $table->decimal(
                    'iva',
                    12,
                    2
                )->default(0);

                $table->decimal(
                    'total',
                    12,
                    2
                )->default(0);

                $table->enum(
                    'estado',
                    [
                        'borrador',
                        'emitida',
                        'cancelada'
                    ]
                )->default(
                    'borrador'
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
            'facturas'
        );
    }
};
