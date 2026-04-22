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
        Schema::create('aulas', function (Blueprint $table) {
            $table->id();
            // A aula pertence a uma disciplina
            $table->foreignId('disciplina_id')->constrained('disciplinas')->onDelete('cascade');
            
            $table->string('titulo'); // Ex: "Aula 01 - Introdução"
            $table->string('url_video')->nullable(); // O link do YouTube
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aulas');
    }
};
