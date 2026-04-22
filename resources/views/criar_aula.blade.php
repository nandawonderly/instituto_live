@extends('layout_admin')

@section('conteudo')

<main class="content-area"> 
    <div class="header-acoes">
        <div>
            <a href="/admin/disciplinas/{{ $disciplina->id }}" class="btn-voltar">← Voltar</a>
            <h2 style="margin-top: 10px;">Nova Aula em: {{ $disciplina->nome }}</h2>
        </div>
    </div>

    <div class="form-container" style="margin-top: 20px;">
        <form action="/admin/disciplinas/{{ $disciplina->id }}/aulas" method="POST" enctype="multipart/form-data">
                @csrf
            
            <div class="form-group">
                <label>Título da Aula: *</label>
                <input type="text" name="titulo" required placeholder="Ex: Aula 01 - Boas Vindas">
            </div>

            <div class="form-group">
                <label>Descrição (Opcional):</label>
                <textarea name="descricao" placeholder="Digite as instruções para esta aula..."></textarea>
            </div>

            <div class="form-group" id="container-videos">
                <label>Links do YouTube (Opcional):</label>
                
                <div class="video-input-group" style="display: flex; gap: 10px; margin-bottom: 10px; align-items: stretch;">
                    
                    <input type="url" name="url_video[]" placeholder="https://www.youtube.com/watch?v=..." style="flex: 1; width: 100%;">
                    
                    <button type="button" onclick="adicionarVideo()" style="background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-weight: bold; flex-shrink: 0; width: auto; white-space: nowrap;">
                        + Adicionar
                    </button>
                </div>
            </div>

            <script>
            function adicionarVideo() {
                const container = document.getElementById('container-videos');
                const div = document.createElement('div');
                div.className = 'video-input-group';
                div.style = 'display: flex; gap: 10px; margin-bottom: 10px; align-items: stretch;';
                
                div.innerHTML = `
                    <input type="url" name="url_video[]" placeholder="https://www.youtube.com/watch?v=..." style="flex: 1; width: 100%;">
                    <button type="button" onclick="this.parentElement.remove()" style="background-color: #dc3545; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-weight: bold; flex-shrink: 0; width: auto; white-space: nowrap;">
                        - Remover
                    </button>
                `;
                
                container.appendChild(div);
            }
            </script>

            <div class="form-group" style="padding: 20px; border: 2px dashed #ccc; border-radius: 8px; background: #fafafa;">
                <label style="display:block; margin-bottom: 10px; font-weight: 600;">Materiais Complementares (PDF, Slides) - Opcional:</label>
                <input type="file" name="arquivos[]" multiple accept=".pdf,.ppt,.pptx,.doc,.docx">
                <p style="font-size: 12px; color: #666; margin-top: 5px;">Você pode selecionar vários arquivos de uma vez.</p>
            </div>

            <button type="submit" class="btn-submit" style="margin-top: 20px;">Salvar Aula Completa</button>
        </form>
    </div>
</main>
@endsection