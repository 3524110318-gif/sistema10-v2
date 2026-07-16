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
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('prospecto_comercial_id')
                ->constrained('prospectos_comerciales')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('folio')->unique();

            $table->date('fecha');

            $table->decimal('monto',12,2);

            $table->integer('numero_plazas');

            $table->integer('vigencia_dias')
                ->default(30);

            $table->enum(
                'estatus',
                [
                    'pendiente',
                    'aceptada',
                    'rechazada',
                    'cancelada'
                ]
            )->default('pendiente');

            $table->text('observaciones')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizaciones');
    }
};
