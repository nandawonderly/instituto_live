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
        Schema::table('aulas', function (Blueprint $table) {
            // Adiciona a coluna de descrição permitindo que ela fique vazia
            $table->text('descricao')->nullable()->after('titulo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aulas', function (Blueprint $table) {
            //
        });
    }
};
