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
            'prenominas',
            function (Blueprint $table)
            {
                $table->id();

                $table->date(
                    'periodo_inicio'
                );

                $table->date(
                    'periodo_fin'
                );

                $table->enum(
                    'estatus',
                    [
                        'abierta',
                        'cerrada',
                        'autorizada'
                    ]
                )->default(
                    'abierta'
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
            'prenominas'
        );
    }
};
