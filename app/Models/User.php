<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'tipo_perfil'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Um professor (User) TEM MUITAS disciplinas
    public function disciplinas()
    {
        // O segundo parâmetro avisa o Laravel que a chave lá na tabela disciplinas é 'professor_id'
        return $this->hasMany(Disciplina::class, 'professor_id');
    }

    // Um aluno PERTENCE a um curso
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }
}
