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
            'movimientos_inventario',
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

                $table->enum(
                    'tipo_movimiento',
                    [
                        'entrada',
                        'salida',
                        'devolucion',
                        'ajuste',
                        'merma',
                        'transferencia'
                    ]
                );

                $table->integer(
                    'cantidad'
                );

                $table->integer(
                    'stock_anterior'
                );

                $table->integer(
                    'stock_nuevo'
                );

                $table->dateTime(
                    'fecha_movimiento'
                );

                $table->foreignId(
                    'user_id'
                )
                ->nullable()
                ->constrained(
                    'users'
                )
                ->nullOnDelete();

                $table->string(
                    'referencia'
                )
                ->nullable();

                $table->string(
                    'motivo'
                )
                ->nullable();

                $table->text(
                    'observaciones'
                )
                ->nullable();

                $table->string('origen')
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
            'movimientos_inventario'
        );
    }
};
