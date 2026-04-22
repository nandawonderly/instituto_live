@extends('layout_admin')

@section('conteudo')

<main class="content-area">
    <div class="header-acoes">
        <div>
            <h2>🎯 Criar Quiz: {{ $aula->titulo }}</h2>
            <p>Questões já cadastradas: <strong>{{ $aula->questoes->count() }}</strong></p>
        </div>
    </div>

    @if(session('sucesso'))
        <div style="background: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
            {{ session('sucesso') }}
        </div>
    @endif

    <div class="form-container" style="margin-top: 20px;">
        <form method="POST" action="/admin/aulas/{{ $aula->id }}/quiz">
            @csrf
            
            <div class="form-group">
                <label for="enunciado">Enunciado da Questão:</label>
                <textarea id="enunciado" name="enunciado" rows="3" required placeholder="Ex: Qual o resultado de 2+2?"></textarea>
            </div>

            <div class="form-group">
                <label>Alternativas:</label>
                @foreach(['A', 'B', 'C'] as $index => $letra)
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                    <input type="radio" name="correta" value="{{ $index }}" required>
                    <input type="text" name="alternativas[]" placeholder="Opção {{ $letra }}" required style="flex: 1;">
                </div>
                @endforeach
            </div>

            <div style="margin-top: 30px; display: flex; gap: 15px;">
                <button type="submit" name="acao" value="proxima" class="btn-submit" style="background-color: #007bff; flex: 1;">
                    Salvar e Adicionar Outra
                </button>

                <button type="submit" name="acao" value="finalizar" class="btn-submit" style="background-color: #28a745; flex: 1;">
                    Salvar e Finalizar Quiz
                </button>
            </div>

            <div style="text-align: center; margin-top: 20px;">
                <a href="/admin/disciplinas/{{ $aula->disciplina_id }}" style="color: #666; text-decoration: none;">
                    Sair sem salvar esta questão
                </a>
            </div>
        </form>
    </div>

    @if($aula->questoes->count() > 0)
    <div class="form-container" style="margin-top: 40px; background: #f8f9fa;">
        <h4>Questões já adicionadas:</h4>
        <ul style="margin-top: 10px; list-style: none; padding: 0;">
            @foreach($aula->questoes as $q)
                <li style="padding: 10px; border-bottom: 1px solid #ddd;">
                    <strong>{{ $loop->iteration }}.</strong> {{ $q->enunciado }}
                </li>
            @endforeach
        </ul>
    </div>
    @endif
</main>

@endsection