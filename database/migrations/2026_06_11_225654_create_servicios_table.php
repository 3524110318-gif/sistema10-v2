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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
             $table->foreignId(
                'contrato_id'
            )
            ->constrained('contratos')
            ->onDelete('cascade');

            $table->string(
                'nombre'
            );

            $table->text(
                'direccion'
            );

            $table->string(
                'municipio'
            )->nullable();

            $table->decimal(
                'latitud',
                10,
                7
            )->nullable();

            $table->decimal(
                'longitud',
                10,
                7
            )->nullable();

            $table->enum(
                'estado',
                [
                    'activo',
                    'suspendido',
                    'finalizado'
                ]
            )->default(
                'activo'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
