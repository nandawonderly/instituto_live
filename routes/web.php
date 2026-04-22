<?php

use Illuminate\Support\Facades\Route;

// Importando todos os seus Controllers:
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DisciplinaController; 
use App\Http\Controllers\AulaController;       
use App\Http\Controllers\ProfessorController;  
use App\Http\Controllers\AlunoController;

use App\Models\Curso;

// Rota para salvar o curso
Route::post('/admin/cursos', [CursoController::class, 'salvarCurso']);

// Essa rota apenas MOSTRA a tela (foi a que criamos antes)
Route::get('/', function () {
    return view('index');

});

// Essa rota RECEBE os dados do formulário e faz o login
Route::post('/logar', [AuthController::class, 'logar']);
// Rota do Painel da Administradora
Route::get('/admin', function () {
    
    // Verificação de segurança: Se não estiver logado ou não for admin, manda pro login
    if (session('tipo_perfil') !== 'admin') {
        return redirect('/');
    }

    // Se estiver tudo certo, mostra a página!
    return view('painel_admin'); 
    
});

// Rota do Painel do Aluno
Route::get('/aluno', function () {
    
    // 1. Verificação de segurança
    if (session('tipo_perfil') !== 'aluno') {
        return redirect('/');
    }

    // 2. Pegamos o nome completo da sessão do Laravel
    $nome_completo = session('usuario_nome');
    
    // 3. Cortamos para pegar só o primeiro nome
    $primeiro_nome = explode(' ', trim($nome_completo))[0];

    // 4. Mandamos a variável para a View!
    return view('painel_aluno', [
        'primeiro_nome' => $primeiro_nome
    ]); 
    
});

// Rota do Painel do Professor
Route::get('/professor', function () {
    
    // 1. Verificação de segurança
    if (session('tipo_perfil') !== 'professor') {
        return redirect('/');
    }

    // 2. Pegamos o nome completo da sessão do Laravel
    $nome_completo = session('usuario_nome');
    
    // 3. Cortamos para pegar só o primeiro nome
    $primeiro_nome = explode(' ', trim($nome_completo))[0];

    // 4. Mandamos a variável para a View!
    return view('painel_professor', [
        'primeiro_nome' => $primeiro_nome
    ]); 
    
});

// Rota para fazer o Logout
Route::get('/logout', function () {
    
    // O comando flush() do Laravel substitui o session_destroy() do PHP puro.
    // Ele apaga tudo e "esquece" quem estava logado.
    session()->flush();

    // Manda de volta para a tela de login
    return redirect('/');
});

// Rota da página Início (Dashboard)
Route::get('/admin', function () {
    if (session('tipo_perfil') !== 'admin') return redirect('/');
    return view('painel_admin'); 
});

// 1. A LISTA: Onde você vê todos os cursos (o que deve abrir primeiro)
Route::get('/admin/cursos', function () {
    if (session('tipo_perfil') !== 'admin') return redirect('/');
    $cursos = App\Models\Curso::all();
    return view('gerenciar_cursos', ['cursos' => $cursos]);
});

// 2. O FORMULÁRIO: Apenas para criar um curso novo
Route::get('/admin/cursos/novo', function () {
    if (session('tipo_perfil') !== 'admin') return redirect('/');
    return view('criar_cursos');
});

// 3. OS DETALHES: Onde você clica em um curso e vê as disciplinas dele
Route::get('/admin/cursos/{id}', function ($id) {
    if (session('tipo_perfil') !== 'admin') return redirect('/');
    // Busca o curso pelo ID junto com as disciplinas ligadas a ele
    $curso = Curso::with('disciplinas')->find($id); 
    return view('detalhes_curso', ['curso' => $curso]);
});

// MOSTRAR o formulário da disciplina
Route::get('/admin/cursos/{id}/disciplinas/nova', function ($id) {
    if (session('tipo_perfil') !== 'admin') return redirect('/');
    $curso = \App\Models\Curso::find($id);
    return view('criar_disciplina', ['curso' => $curso]);
});

// SALVAR a disciplina
Route::post('/admin/cursos/{id}/disciplinas', [DisciplinaController::class, 'salvar']);

// 1. Mostrar detalhes da Disciplina (Lista de Aulas)
Route::get('/admin/disciplinas/{id}', function ($id) {
    if (session('tipo_perfil') !== 'admin') return redirect('/');
    // Busca a disciplina junto com as aulas E os materiais delas
    $disciplina = \App\Models\Disciplina::with('aulas.materiais')->find($id);
    return view('detalhes_disciplina', ['disciplina' => $disciplina]);
});

// 2. Mostrar formulário da Nova Aula
Route::get('/admin/disciplinas/{id}/aulas/nova', function ($id) {
    if (session('tipo_perfil') !== 'admin') return redirect('/');
    $disciplina = \App\Models\Disciplina::find($id);
    return view('criar_aula', ['disciplina' => $disciplina]);
});

// 3. Salvar a Aula
Route::post('/admin/disciplinas/{id}/aulas', [AulaController::class, 'salvar']);

// Editar Aula (Mostrar o form)
Route::get('/admin/aulas/{id}/editar', [AulaController::class, 'editar']);

// Atualizar Aula no Banco (O método PUT que falsificamos lá no HTML)
Route::put('/admin/aulas/{id}', [AulaController::class, 'atualizar']);

// Excluir Aula (O método DELETE)
Route::delete('/admin/aulas/{id}', [AulaController::class, 'excluir']);

// Ver detalhes de uma aula (Preview com vídeo e arquivos)
Route::get('/admin/aulas/{id}', [AulaController::class, 'ver']);

// Deletar Curso
Route::delete('/admin/cursos/{id}', [App\Http\Controllers\CursoController::class, 'excluir']);

// Deletar Disciplina
Route::delete('/admin/disciplinas/{id}', [App\Http\Controllers\DisciplinaController::class, 'excluir']);

// Rota para MOSTRAR a nova página de adicionar quiz
Route::get('/admin/aulas/{id}/quiz', [AulaController::class, 'novoQuiz']);

// Rota para SALVAR o quiz vindo dessa nova página
Route::post('/admin/aulas/{id}/quiz', [AulaController::class, 'salvarQuestao']);

// Rota para mostrar a tela de professores
Route::get('/admin/professores', [App\Http\Controllers\ProfessorController::class, 'index']);

// Rota para salvar um professor novo
Route::post('/admin/professores', [App\Http\Controllers\ProfessorController::class, 'store']);

// Rota para vincular um professor a uma disciplina
Route::post('/admin/professores/vincular', [App\Http\Controllers\ProfessorController::class, 'vincularDisciplina']);

// Rota para DELETAR um professor
Route::delete('/admin/professores/{id}', [App\Http\Controllers\ProfessorController::class, 'destroy']);

// ==========================================
// ROTAS DE GERENCIAMENTO DE ALUNOS
// ==========================================
Route::get('/admin/alunos', [AlunoController::class, 'index']); // Mostra a tela
Route::post('/admin/alunos', [AlunoController::class, 'store']); // Salva a matrícula
Route::delete('/admin/alunos/{id}', [AlunoController::class, 'destroy']); // Exclui a matrícula