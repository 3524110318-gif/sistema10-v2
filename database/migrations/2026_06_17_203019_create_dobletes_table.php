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
        Schema::create('dobletes', function (Blueprint $table) {
            $table->id();
             $table->foreignId(
                'empleado_id'
            )->constrained(
                'empleados'
            )->cascadeOnDelete();

            $table->foreignId(
                'plaza_operativa_id'
            )->constrained(
                'plaza_operativas'
            )->cascadeOnDelete();

            $table->string(
                'guardia_ausente'
            );

            $table->date(
                'fecha'
            );

            $table->text(
                'motivo'
            );

            $table->enum(
                'estado',
                [
                    'activo',
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
        Schema::dropIfExists('dobletes');
    }
};
