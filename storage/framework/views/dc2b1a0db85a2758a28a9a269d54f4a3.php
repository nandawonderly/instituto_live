

<?php $__env->startSection('conteudo'); ?>

<main class="content-area">
    <div class="header-acoes">        
        <div>
            <a href="/admin/disciplinas/<?php echo e($aula->disciplina_id); ?>" class="btn-voltar">← Voltar para Disciplina</a>
            <h2 style="margin-top: 10px;"><?php echo e($aula->titulo); ?></h2>
        </div>
    </div>

    <div class="aula-conteudo" style="margin-top: 20px; background: white; padding: 0px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">

        <?php if(!empty($aula->url_video)): ?>
            <div class="area-dos-videos" style="display: flex; flex-direction: column; gap: 30px; margin-top: 20px;">
                
                <?php $__currentLoopData = $aula->url_video; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        // Mágica para converter o link normal em link de iFrame
                        // Troca 'watch?v=' por 'embed/'
                        $embedUrl = str_replace('watch?v=', 'embed/', $link);
                        // Remove partes extras do link (como &list= ou &t=) que podem quebrar o vídeo
                        $embedUrl = explode('&', $embedUrl)[0];
                    ?>

                    <div class="video-container">
                        <h4 style="margin-bottom: 10px; color: #444;">Vídeo <?php echo e($index + 1); ?></h4>
                        <iframe 
                            width="100%" 
                            height="450" 
                            src="<?php echo e($embedUrl); ?>" 
                            title="Vídeo da Aula" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen 
                            style="border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        </iframe>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            </div>
        <?php endif; ?>

        <?php if($aula->descricao): ?>
            <div class="descricao-aula" style="margin-bottom: 30px;">
                <h3 style="color: #1c4a8a; margin-bottom: 10px;">Sobre esta aula:</h3>
                <p style="line-height: 1.6; color: #444; font-size: 15px;"><?php echo nl2br(e($aula->descricao)); ?></p>
            </div>
        <?php endif; ?>

        <?php if($aula->materiais->count() > 0): ?>
            <div class="materiais-aula" style="border-top: 1px solid #eaeaea; padding-top: 20px;">
                <h3 style="color: #1c4a8a; margin-bottom: 15px;">Materiais Complementares:</h3>
                <ul style="list-style: none; padding: 0;">
                    
                    <?php $__currentLoopData = $aula->materiais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li style="margin-bottom: 10px;">
                            <a href="<?php echo e(asset($material->caminho)); ?>" download class="btn-voltar" style="display: inline-block; width: auto; background-color: #f8fafc; border: 1px solid #e2e8f0;">
                                📄 Baixar: <?php echo e($material->nome_arquivo); ?>

                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                </ul>
            </div>
        <?php endif; ?>
        <hr style="margin: 40px 0; border-top: 1px solid #ccc;">

        <div class="header-acoes" style="margin-bottom: 20px;">
            <h3>🎯 Teste seus Conhecimentos</h3>
            <p style="color: #666;">Responda às questões abaixo para fixar o conteúdo desta aula.</p>
        </div>

        <?php if($aula->questoes->count() > 0): ?>
            
            <div id="area-quiz-interativo">
                <?php $__currentLoopData = $aula->questoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $questao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bloco-questao" style="background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        
                        <h4 style="margin-bottom: 15px; color: #333;">
                            <strong><?php echo e($index + 1); ?>.</strong> <?php echo e($questao->enunciado); ?>

                        </h4>

                        <div class="alternativas-list">
                            <?php $__currentLoopData = $questao->alternativas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <label class="label-alternativa" style="display: block; padding: 12px; margin-bottom: 8px; border-radius: 5px; border: 1px solid #eee; background-color: #fafafa; cursor: pointer; transition: 0.2s;">
                                    
                                    <input type="radio" name="questao_<?php echo e($questao->id); ?>" value="<?php echo e($alt->id); ?>" 
                                        data-correta="<?php echo e($alt->is_correta ? '1' : '0'); ?>" 
                                        style="margin-right: 10px;">
                                    
                                    <span class="texto-alt"><?php echo e($alt->texto); ?></span>
                                </label>
                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
                    let totalQuestoes = <?php echo e($aula->questoes->count()); ?>;
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

        <?php else: ?>
            <div style="background: #f8f9fa; border: 2px dashed #ccc; padding: 30px; text-align: center; border-radius: 8px;">
                <p style="color: #666; margin-bottom: 0; font-size: 16px;">
                    Nenhum teste disponível para esta aula no momento.
                </p>
            </div>
        <?php endif; ?>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ferna\Documents\site cintia curso\instituto_live\resources\views/detalhes_aula.blade.php ENDPATH**/ ?>