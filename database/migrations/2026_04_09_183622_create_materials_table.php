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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            // O material pertence a uma aula
            $table->foreignId('aula_id')->constrained('aulas')->onDelete('cascade');
            
            $table->string('nome_arquivo'); // Ex: "Apostila_Aula_1.pdf"
            $table->string('caminho'); // Onde o PDF está salvo na pasta public
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
