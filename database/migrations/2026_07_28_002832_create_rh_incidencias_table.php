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
        Schema::create('rh_incidencias', function (Blueprint $table) {

            $table->id();

            $table->foreignId('empleado_id')
                ->constrained('empleados')
                ->cascadeOnDelete();

            $table->enum('tipo', [
                'falta',
                'retardo',
                'permiso',
                'incapacidad',
            ]);

            $table->date('fecha');

            $table->string('folio_incapacidad')
                ->nullable();

            $table->text('descripcion')
                ->nullable();

            $table->enum('estado', [
                'pendiente',
                'justificada',
                'injustificada',
            ])->default('pendiente');

            $table->timestamps();

            $table->unique(
                [
                    'empleado_id',
                    'tipo',
                    'fecha',
                ],
                'rh_incidencias_unica'
            );

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rh_incidencias');
    }
};