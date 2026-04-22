@extends('layout_admin')

@section('conteudo')
<main class="content-area">
    <div class="header-acoes">
        <div>
            <a href="/admin/cursos" class="btn-voltar">← Voltar para Lista de Cursos</a>
            <h2 style="margin-top: 10px;">Curso: {{ $curso->nome }}</h2>
        </div>
        <a href="/admin/cursos/{{ $curso->id }}/disciplinas/nova" class="btn-submit" style="width: auto; padding: 10px 20px; text-decoration: none;">+ Nova Disciplina</a>
    </div>

    <div class="lista-disciplinas" style="margin-top: 30px;">
        <h3>Disciplinas deste Curso:</h3>
        <ul style="list-style: none; padding: 0; margin-top: 15px;">
            @forelse($curso->disciplinas as $disciplina)
                <li style="padding: 15px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <strong>{{ $disciplina->nome }}</strong>
                        <p style="font-size: 13px; color: #666; margin-top: 5px;">{{ $disciplina->descricao }}</p>
                    </div>
                    <form action="/admin/disciplinas/{{ $disciplina->id }}" method="POST" onsubmit="return confirm('Tem certeza que deseja apagar esta disciplina e TODAS as suas aulas?');"
                     style="margin: 0; margin-left: auto; padding: 10px">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background-color: #fee2e2; color: #991b1b; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: 500; font-size: 14px;">Excluir</button>
                    </form>
                    <a href="/admin/disciplinas/{{ $disciplina->id }}" class="btn-editar" style="text-decoration: none;">Ver Aulas</a>
                </li>
            @empty
                <p style="color: #999; margin-top: 10px;">Nenhuma disciplina cadastrada para este curso ainda.</p>
            @endforelse
        </ul>
    </div>
</main>
@endsection