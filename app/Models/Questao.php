<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questao extends Model
{
    use HasFactory;

    // A variável $table é útil aqui para o Laravel não se confundir com o plural em português
    protected $table = 'questoes';

    // Liberamos quais campos podem ser salvos em massa pelo painel da administradora
    protected $fillable = [
        'aula_id',
        'enunciado',
    ];

    // Uma questão PERTENCE a uma aula específica
    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }

    // Uma questão TEM VÁRIAS alternativas (A, B, C...)
    public function alternativas()
    {
        return $this->hasMany(Alternativa::class);
    }
}