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
        Schema::create('repses', function (Blueprint $table) {

            $table->id();

            // Relación con el empleado
            $table->foreignId('empleado_id')
                ->unique()
                ->constrained('empleados')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

        

            $table->boolean('alta_imss')
                ->default(false);

            $table->boolean('contrato_firmado')
                ->default(false);

            $table->boolean('cedula_ssp')
                ->default(false);

            $table->boolean('constancia_fiscal')
                ->default(false);


            $table->date('vigencia_alta_imss')
                ->nullable();

            $table->date('vigencia_contrato')
                ->nullable();

            $table->date('vigencia_cedula_ssp')
                ->nullable();

            $table->date('vigencia_constancia_fiscal')
                ->nullable();


            $table->string('archivo_imss')
                ->nullable();

            $table->string('archivo_contrato')
                ->nullable();

            $table->string('archivo_cedula_ssp')
                ->nullable();

            $table->string('archivo_constancia_fiscal')
                ->nullable();

            $table->enum(
                'estatus',
                [
                    'cumple',
                    'pendiente',
                    'bloqueado'
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
        Schema::dropIfExists('repses');
    }
};