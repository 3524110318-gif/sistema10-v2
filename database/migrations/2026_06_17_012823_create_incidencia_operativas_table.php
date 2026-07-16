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
        Schema::create('incidencia_operativas', function (Blueprint $table) {
            $table->id();
             $table->foreignId(
                'servicio_id'
            )->constrained(
                'servicios'
            )->cascadeOnDelete();

            $table->foreignId(
                'supervision_id'
            )->nullable()
            ->constrained(
                'supervisions'
            )->nullOnDelete();

            $table->enum(
                'tipo',
                [
                    'ausencia',
                    'retardo',
                    'cliente',
                    'robo',
                    'accidente',
                    'novedad',
                ]
            );

            $table->text(
                'descripcion'
            );

            $table->string(
                'folio_fisico'
            )->nullable();

            $table->enum(
                'estado',
                [
                    'abierta',
                    'en_revision',
                    'cerrada',
                ]
            )->default(
                'abierta'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidencia_operativas');
    }
};
