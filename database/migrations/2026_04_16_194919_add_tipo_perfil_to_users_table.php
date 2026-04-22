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
        Schema::table('users', function (Blueprint $table) {
            // Adiciona a coluna para definir o tipo de usuário.
            // Coloquei o padrão como 'aluno' para que registros normais não fiquem vazios.
            $table->string('tipo_perfil')->default('aluno')->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Desfaz a alteração caso precise reverter
            $table->dropColumn('tipo_perfil');
        });
    }
};
