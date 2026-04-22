<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    // 1. Libera essas colunas para salvar
    protected $fillable = [
        'nome', 
        'descricao'
    ];

    // 2. Conexão para baixo: Um Curso tem várias Disciplinas
    public function disciplinas()
    {
        return $this->hasMany(Disciplina::class);
    }

    // Um curso TEM MUITOS alunos
    public function alunos()
    {
        return $this->hasMany(User::class, 'curso_id')->where('tipo_perfil', 'aluno');
    }
}