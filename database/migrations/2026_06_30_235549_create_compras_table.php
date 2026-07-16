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
            'compras',
            function (Blueprint $table)
            {
                $table->id();

                $table->foreignId(
                    'proveedor_id'
                )
                ->constrained(
                    'proveedores'
                )
                ->cascadeOnUpdate()
                ->restrictOnDelete();

                $table->string(
                    'folio'
                )->unique();

                $table->date(
                    'fecha_compra'
                );

                $table->decimal(
                    'subtotal',
                    10,
                    2
                )->default(0);

                $table->decimal(
                    'iva',
                    10,
                    2
                )->default(0);

                $table->decimal(
                    'total',
                    10,
                    2
                )->default(0);

                $table->enum(
                    'estado',
                    [
                        'pendiente',
                        'recibida',
                        'cancelada'
                    ]
                )->default(

                    'pendiente'
                );

                $table->text(
                    'observaciones'
                )->nullable();

                $table->foreignId('user_id')
                    ->nullable()
                    ->constrained('users')
                    ->nullOnDelete();

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
            'compras'
        );
    }
};
