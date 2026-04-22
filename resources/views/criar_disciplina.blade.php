@extends('layout_admin')

@section('conteudo')

<main class="content-area">
    <div class="header-acoes">
        <div>
            <a href="/admin/cursos/{{ $curso->id }}" class="btn-voltar">Voltar para Curso</a>
            <h2 style="margin-top: 10px;">Nova Disciplina em: {{ $curso->nome }}</h2>
        </div>
    </div>

    <div class="form-container" style="margin-top: 20px;">
        <form action="/admin/cursos/{{ $curso->id }}/disciplinas" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="nome_disciplina">Nome da Disciplina:</label>
                <input type="text" id="nome_disciplina" name="nome" required placeholder="Ex: Anatomia Básica">
            </div>

            <div class="form-group">
                <label for="descricao_disciplina">Descrição da Disciplina:</label>
                <textarea id="descricao_disciplina" name="descricao" rows="3" placeholder="Resumo do que será ensinado..."></textarea>
            </div>

            <button type="submit" class="btn-submit">Salvar Disciplina</button>
        </form>
    </div>
</main>
@endsection