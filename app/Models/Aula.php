<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    // 1. Libera essas colunas para serem salvas no banco de dados
    protected $fillable = [
        'disciplina_id',
        'titulo',
        'descricao',
        'url_video'
    ];

    // 2. Conexão para cima: Uma aula pertence a uma Disciplina
    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class);
    }

    // 3. Conexão para baixo: Uma aula tem vários Materiais (PDFs, slides)
    public function materiais()
    {
        return $this->hasMany(Material::class);
    }

    // Esse é o Accessor! Você vai poder usar $aula->embed_url no seu HTML
    public function getEmbedUrlAttribute()
    {
        // Se não tiver vídeo, não faz nada
        if (!$this->url_video) {
            return null;
        }

        // Essa é uma fórmula mágica (Regex) que procura onde está o "código" do vídeo no meio do link
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $this->url_video, $match);
        
        // Se ele achar o código (que tem sempre 11 letras/números), ele monta o link do Player!
        if (isset($match[1])) {
            return 'https://www.youtube.com/embed/' . $match[1];
        }
        
        return null; // Retorna nulo se for um link inválido
    }

    protected function casts(): array
    {
        return [
            'url_video' => 'array', // <-- Adicione esta linha!
        ];
    }

    // Uma aula PODE ter várias questões
    public function questoes()
    {
        return $this->hasMany(Questao::class);
    }
}