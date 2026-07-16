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
            'productos',
            function (Blueprint $table)
            {
                $table->id();

                $table->foreignId(
                    'categoria_producto_id'
                )
                ->constrained(
                    'categorias_productos'
                )
                ->cascadeOnUpdate()
                ->restrictOnDelete();

                $table->string(
                    'codigo'
                )->unique();

                $table->string(
                    'nombre'
                );

                $table->text(
                    'descripcion'
                )->nullable();

                $table->enum(
                    'unidad_medida',
                    [
                        'Pieza',
                        'Caja',
                        'Par',
                        'Paquete',
                        'Juego',
                        'Kilogramo',
                        'Litro',
                        'Metro'
                    ]
                )->default('Pieza');

                $table->integer(
                    'stock_actual'
                )->default(0);

                $table->integer(
                    'stock_minimo'
                )->default(0);

                $table->decimal(
                    'precio_compra',
                    10,
                    2
                )->default(0);

                $table->enum(
                    'estado',
                    [
                        'activo',
                        'inactivo'
                    ]
                )->default(
                    'activo'
                );

                $table->enum(
                    'tipo_producto',
                    [
                        'consumible',
                        'activo'
                    ]
                )->default(
                    'consumible'
                );

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
            'productos'
        );
    }
};
