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
    Schema::create('questoes', function (Blueprint $table) {
        $table->id();
        // Liga a questão à aula. Se a aula for deletada, as questões somem junto (cascade)
        $table->foreignId('aula_id')->constrained('aulas')->onDelete('cascade');
        $table->text('enunciado'); 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questoes');
    }
};
