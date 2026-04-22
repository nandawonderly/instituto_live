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
    Schema::table('disciplinas', function (Blueprint $table) {
        // Cria a conexão: Uma disciplina pertence a um professor
        $table->foreignId('professor_id')->nullable()->constrained('users')->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('disciplinas', function (Blueprint $table) {
            //
        });
    }
};
