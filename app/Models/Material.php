<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    // 1. Libera essas colunas para o upload funcionar
    protected $fillable = [
        'aula_id',
        'nome_arquivo',
        'caminho'
    ];

    // 2. Conexão para cima: Um material pertence a uma Aula
    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }
}