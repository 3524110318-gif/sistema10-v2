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
        Schema::table(
            'log_actividads',
            function (Blueprint $table) {

                $table->foreignId('user_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('users')
                    ->nullOnDelete();

                $table->string('rol', 50)
                    ->nullable()
                    ->after('usuario');

                $table->json('valor_anterior')
                    ->nullable()
                    ->after('accion');

                $table->json('valor_nuevo')
                    ->nullable()
                    ->after('valor_anterior');

                $table->string('ip', 45)
                    ->nullable()
                    ->after('valor_nuevo');

                $table->text('user_agent')
                    ->nullable()
                    ->after('ip');
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(
            'log_actividads',
            function (Blueprint $table) {

                $table->dropForeign([
                    'user_id',
                ]);

                $table->dropColumn([
                    'user_id',
                    'rol',
                    'valor_anterior',
                    'valor_nuevo',
                    'ip',
                    'user_agent',
                ]);
            }
        );
    }
};