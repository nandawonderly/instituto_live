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
    Schema::create('alternativas', function (Blueprint $table) {
        $table->id();
        // Liga a alternativa à questão específica
        $table->foreignId('questao_id')->constrained('questoes')->onDelete('cascade');
        $table->string('texto');
        // Este campo define se esta é a resposta certa (1) ou errada (0)
        $table->boolean('is_correta')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alternativas');
    }
};
