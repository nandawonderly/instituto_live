@extends('layout_admin')

@section('conteudo')

<main class="content-area">
    <div class="header-acoes">        
        <div>
            <a href="/admin/disciplinas/{{ $aula->disciplina_id }}" class="btn-voltar">← Voltar para Disciplina</a>
            <h2 style="margin-top: 10px;">{{ $aula->titulo }}</h2>
        </div>
    </div>

    <div class="aula-conteudo" style="margin-top: 20px; background: white; padding: 0px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">

        @if(!empty($aula->url_video))
            <div class="area-dos-videos" style="display: flex; flex-direction: column; gap: 30px; margin-top: 20px;">
                
                @foreach($aula->url_video as $index => $link)
                    @php
                        // Mágica para converter o link normal em link de iFrame
                        // Troca 'watch?v=' por 'embed/'
                        $embedUrl = str_replace('watch?v=', 'embed/', $link);
                        // Remove partes extras do link (como &list= ou &t=) que podem quebrar o vídeo
                        $embedUrl = explode('&', $embedUrl)[0];
                    @endphp

                    <div class="video-container">
                        <h4 style="margin-bottom: 10px; color: #444;">Vídeo {{ $index + 1 }}</h4>
                        <iframe 
                            width="100%" 
                            height="450" 
                            src="{{ $embedUrl }}" 
                            title="Vídeo da Aula" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen 
                            style="border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        </iframe>
                    </div>
                @endforeach
                
            </div>
        @endif

        @if($aula->descricao)
            <div class="descricao-aula" style="margin-bottom: 30px;">
                <h3 style="color: #1c4a8a; margin-bottom: 10px;">Sobre esta aula:</h3>
                <p style="line-height: 1.6; color: #444; font-size: 15px;">{!! nl2br(e($aula->descricao)) !!}</p>
            </div>
        @endif

        @if($aula->materiais->count() > 0)
            <div class="materiais-aula" style="border-top: 1px solid #eaeaea; padding-top: 20px;">
                <h3 style="color: #1c4a8a; margin-bottom: 15px;">Materiais Complementares:</h3>
                <ul style="list-style: none; padding: 0;">
                    
                    @foreach($aula->materiais as $material)
                        <li style="margin-bottom: 10px;">
                            <a href="{{ asset($material->caminho) }}" download class="btn-voltar" style="display: inline-block; width: auto; background-color: #f8fafc; border: 1px solid #e2e8f0;">
                                📄 Baixar: {{ $material->nome_arquivo }}
                            </a>
                        </li>
                    @endforeach
                    
                </ul>
            </div>
        @endif
        <hr style="margin: 40px 0; border-top: 1px solid #ccc;">

        <div class="header-acoes" style="margin-bottom: 20px;">
            <h3>🎯 Teste seus Conhecimentos</h3>
            <p style="color: #666;">Responda às questões abaixo para fixar o conteúdo desta aula.</p>
        </div>

        @if($aula->questoes->count() > 0)
            
            <div id="area-quiz-interativo">
                @foreach($aula->questoes as $index => $questao)
                    <div class="bloco-questao" style="background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        
                        <h4 style="margin-bottom: 15px; color: #333;">
                            <strong>{{ $index + 1 }}.</strong> {{ $questao->enunciado }}
                        </h4>

                        <div class="alternativas-list">
                            @foreach($questao->alternativas as $alt)
                                
                                <label class="label-alternativa" style="display: block; padding: 12px; margin-bottom: 8px; border-radius: 5px; border: 1px solid #eee; background-color: #fafafa; cursor: pointer; transition: 0.2s;">
                                    
                                    <input type="radio" name="questao_{{ $questao->id }}" value="{{ $alt->id }}" 
                                        data-correta="{{ $alt->is_correta ? '1' : '0' }}" 
                                        style="margin-right: 10px;">
                                    
                                    <span class="texto-alt">{{ $alt->texto }}</span>
                                </label>
                                
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <button id="btn-corrigir-quiz" class="btn-submit" style="width: 100%; padding: 15px; font-size: 16px;">
                    Finalizar e Ver Resultado
                </button>

                <div id="resultado-quiz" style="display: none; text-align: center; margin-top: 20px; padding: 20px; border-radius: 8px; background-color: #e8f5e9; border: 2px solid #28a745;">
                    <h3 id="texto-nota" style="color: #155724; margin: 0;"></h3>
                </div>
            </div>

            <script>
                document.getElementById('btn-corrigir-quiz').addEventListener('click', function() {
                    let score = 0;
                    let totalQuestoes = {{ $aula->questoes->count() }};
                    let blocosQuestoes = document.querySelectorAll('.bloco-questao');

                    blocosQuestoes.forEach(bloco => {
                        // Pega qual rádio o aluno selecionou nesta questão
                        let selecionado = bloco.querySelector('input[type="radio"]:checked');
                        let todosRadios = bloco.querySelectorAll('input[type="radio"]');

                        todosRadios.forEach(radio => {
                            let label = radio.closest('.label-alternativa');
                            let isCorreta = radio.getAttribute('data-correta') === '1';

                            // Trava o quiz para ele não mudar a resposta depois de ver
                            radio.disabled = true; 

                            // Pinta as alternativas para mostrar o gabarito
                            if (isCorreta) {
                                // A Certa fica verde
                                label.style.backgroundColor = '#d4edda';
                                label.style.borderColor = '#c3e6cb';
                                label.style.color = '#155724';
                                label.style.fontWeight = 'bold';
                            } else if (radio === selecionado && !isCorreta) {
                                // Se ele selecionou a errada, pinta de vermelho
                                label.style.backgroundColor = '#f8d7da';
                                label.style.borderColor = '#f5c6cb';
                                label.style.color = '#721c24';
                            }
                        });

                        // Conta a pontuação
                        if (selecionado && selecionado.getAttribute('data-correta') === '1') {
                            score++;
                        }
                    });

                    // Esconde o botão e mostra a nota!
                    this.style.display = 'none';
                    let divResultado = document.getElementById('resultado-quiz');
                    let textoNota = document.getElementById('texto-nota');
                    
                    divResultado.style.display = 'block';
                    textoNota.innerText = `🎉 Você acertou ${score} de ${totalQuestoes} questões!`;
                });
            </script>

        @else
            <div style="background: #f8f9fa; border: 2px dashed #ccc; padding: 30px; text-align: center; border-radius: 8px;">
                <p style="color: #666; margin-bottom: 0; font-size: 16px;">
                    Nenhum teste disponível para esta aula no momento.
                </p>
            </div>
        @endif
    </div>
</main>
@endsection