@extends('layout_admin')

@section('conteudo')
    <div class="content-area">
        <div class="header-acoes">
            <h2>Cadastrar Novo Curso</h2>
            <a href="/admin/cursos" class="btn-voltar">Voltar para Lista</a>
        </div>

        <div class="form-container" style="margin-top: 20px;">
            <form action="/admin/cursos" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="nome_curso">Nome do Curso:</label>
                    <input type="text" id="nome_curso" name="nome" required placeholder="Ex: Psicologia Infantil">
                </div>

                <div class="form-group">
                    <label for="descricao_curso">Descrição (Opcional):</label>
                    <textarea id="descricao_curso" name="descricao" placeholder="Breve resumo sobre o curso..."></textarea>
                </div>

                <button type="submit" class="btn-submit">Salvar Curso</button>
            </form>
        </div>
    </div>
@endsection