@extends('layout_admin')

@section('conteudo')

<main class="content-area">
    <div class="header-acoes">
        <div>
            <a href="/admin/disciplinas/{{ $aula->disciplina_id }}" class="btn-voltar">← Cancelar Edição</a>
            <h2 style="margin-top: 10px;">Editar Aula: {{ $aula->titulo }}</h2>
        </div>
    </div>

    <div class="form-container" style="margin-top: 20px;">
        <form action="/admin/aulas/{{ $aula->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
            
            <div class="form-group">
                <label>Título da Aula: *</label>
                <input type="text" name="titulo" value="{{ $aula->titulo }}" required>
            </div>

            <div class="form-group">
                <label>Descrição (Opcional):</label>
                <textarea name="descricao" rows="4">{{ $aula->descricao }}</textarea>
            </div>

            <div class="form-group" id="container-videos">
                <label>Links do YouTube (Opcional):</label>
                
                @if(is_array($aula->url_video) && count($aula->url_video) > 0)
                    @foreach($aula->url_video as $index => $link)
                        <div class="video-input-group" style="display: flex; gap: 10px; margin-bottom: 10px; align-items: stretch;">
                            <input type="url" name="url_video[]" value="{{ $link }}" style="flex: 1; width: 100%;">
                            
                            @if($index === 0)
                                <button type="button" onclick="adicionarVideo()" style="background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-weight: bold; flex-shrink: 0; width: auto; white-space: nowrap;">+ Adicionar</button>
                            @else
                                <button type="button" onclick="this.parentElement.remove()" style="background-color: #dc3545; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-weight: bold; flex-shrink: 0; width: auto; white-space: nowrap;">- Remover</button>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="video-input-group" style="display: flex; gap: 10px; margin-bottom: 10px; align-items: stretch;">
                        <input type="url" name="url_video[]" placeholder="https://www.youtube.com/watch?v=..." style="flex: 1; width: 100%;">
                        <button type="button" onclick="adicionarVideo()" style="background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-weight: bold; flex-shrink: 0; width: auto; white-space: nowrap;">+ Adicionar</button>
                    </div>
                @endif
            </div>

            <div class="form-group" style="padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #fff; margin-top: 20px;">
                <h4 style="margin-top: 0; border-bottom: 1px solid #eee; padding-bottom: 10px;">📎 Arquivos da Aula</h4>

                @if($aula->materiais && $aula->materiais->count() > 0)
                    <div style="margin-bottom: 20px;">
                        <p style="font-size: 14px; color: #555; margin-bottom: 10px;"><strong>Arquivos atuais:</strong> (Marque na caixinha vermelha para excluir)</p>
                        
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            @foreach($aula->materiais as $material)
                                <label style="display: flex; align-items: center; gap: 10px; background: #f8f9fa; padding: 10px; border-radius: 5px; border: 1px solid #eee; cursor: pointer;">
                                    
                                    <input type="checkbox" name="deletar_arquivos[]" value="{{ $material->caminho }}" style="width: 18px; height: 18px; accent-color: red;">
                                    
                                    <span style="color: #dc3545; font-weight: bold;" title="Marcar para exclusão">🗑️</span>
                                    
                                    <a href="{{ asset($material->caminho) }}" target="_blank" style="color: #007bff; text-decoration: none;">
                                        {{ $material->nome_arquivo }}
                                    </a>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div style="padding: 20px; border: 2px dashed #ccc; border-radius: 8px; background-color: #fafafa; text-align: center;">
                    <label for="novos_arquivos" style="display:block; margin-bottom: 10px; font-weight: 600; color: #444; cursor: pointer;">
                        + Adicionar Novos Materiais (PDF, Slides)
                    </label>
                    <input type="file" id="novos_arquivos" name="novos_arquivos[]" multiple accept=".pdf,.ppt,.pptx,.doc,.docx" style="display: block; margin: 0 auto; max-width: 100%;">
                    <p style="font-size: 13px; color: #666; margin-top: 8px;">Os arquivos selecionados aqui serão <strong>somados</strong> aos arquivos já existentes.</p>
                </div>
            </div>

            <button type="submit" class="btn-submit" style="margin-top: 25px; width: 100%;">Salvar Alterações</button>
        </form>
    </div>
</main>

<script>
function adicionarVideo() {
    const container = document.getElementById('container-videos');
    const div = document.createElement('div');
    div.className = 'video-input-group';
    div.style = 'display: flex; gap: 10px; margin-bottom: 10px; align-items: stretch;';
    div.innerHTML = `
        <input type="url" name="url_video[]" placeholder="https://www.youtube.com/watch?v=..." style="flex: 1; width: 100%;">
        <button type="button" onclick="this.parentElement.remove()" style="background-color: #dc3545; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-weight: bold; flex-shrink: 0; width: auto; white-space: nowrap;">- Remover</button>
    `;
    container.appendChild(div);
}
</script>
@endsection