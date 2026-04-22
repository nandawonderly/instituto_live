<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;

    // 1. Libera essas colunas para salvar (incluindo a chave do curso!)
    protected $fillable = [
        'curso_id',
        'nome',
        'descricao'
    ];

    // 2. Conexão para cima: Uma disciplina pertence a um Curso
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    // 3. Conexão para baixo: Uma disciplina tem várias Aulas
    public function aulas()
    {
        return $this->hasMany(Aula::class);
    }
}