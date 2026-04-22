

<?php $__env->startSection('conteudo'); ?>

<main class="content-area">
    <div class="header-acoes">
        <div>
            <a href="/admin/disciplinas/<?php echo e($aula->disciplina_id); ?>" class="btn-voltar">← Cancelar Edição</a>
            <h2 style="margin-top: 10px;">Editar Aula: <?php echo e($aula->titulo); ?></h2>
        </div>
    </div>

    <div class="form-container" style="margin-top: 20px;">
        <form action="/admin/aulas/<?php echo e($aula->id); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?> 
            
            <div class="form-group">
                <label>Título da Aula: *</label>
                <input type="text" name="titulo" value="<?php echo e($aula->titulo); ?>" required>
            </div>

            <div class="form-group">
                <label>Descrição (Opcional):</label>
                <textarea name="descricao" rows="4"><?php echo e($aula->descricao); ?></textarea>
            </div>

            <div class="form-group" id="container-videos">
                <label>Links do YouTube (Opcional):</label>
                
                <?php if(is_array($aula->url_video) && count($aula->url_video) > 0): ?>
                    <?php $__currentLoopData = $aula->url_video; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="video-input-group" style="display: flex; gap: 10px; margin-bottom: 10px; align-items: stretch;">
                            <input type="url" name="url_video[]" value="<?php echo e($link); ?>" style="flex: 1; width: 100%;">
                            
                            <?php if($index === 0): ?>
                                <button type="button" onclick="adicionarVideo()" style="background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-weight: bold; flex-shrink: 0; width: auto; white-space: nowrap;">+ Adicionar</button>
                            <?php else: ?>
                                <button type="button" onclick="this.parentElement.remove()" style="background-color: #dc3545; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-weight: bold; flex-shrink: 0; width: auto; white-space: nowrap;">- Remover</button>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="video-input-group" style="display: flex; gap: 10px; margin-bottom: 10px; align-items: stretch;">
                        <input type="url" name="url_video[]" placeholder="https://www.youtube.com/watch?v=..." style="flex: 1; width: 100%;">
                        <button type="button" onclick="adicionarVideo()" style="background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-weight: bold; flex-shrink: 0; width: auto; white-space: nowrap;">+ Adicionar</button>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group" style="padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #fff; margin-top: 20px;">
                <h4 style="margin-top: 0; border-bottom: 1px solid #eee; padding-bottom: 10px;">📎 Arquivos da Aula</h4>

                <?php if($aula->materiais && $aula->materiais->count() > 0): ?>
                    <div style="margin-bottom: 20px;">
                        <p style="font-size: 14px; color: #555; margin-bottom: 10px;"><strong>Arquivos atuais:</strong> (Marque na caixinha vermelha para excluir)</p>
                        
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <?php $__currentLoopData = $aula->materiais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label style="display: flex; align-items: center; gap: 10px; background: #f8f9fa; padding: 10px; border-radius: 5px; border: 1px solid #eee; cursor: pointer;">
                                    
                                    <input type="checkbox" name="deletar_arquivos[]" value="<?php echo e($material->caminho); ?>" style="width: 18px; height: 18px; accent-color: red;">
                                    
                                    <span style="color: #dc3545; font-weight: bold;" title="Marcar para exclusão">🗑️</span>
                                    
                                    <a href="<?php echo e(asset($material->caminho)); ?>" target="_blank" style="color: #007bff; text-decoration: none;">
                                        <?php echo e($material->nome_arquivo); ?>

                                    </a>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ferna\Documents\site cintia curso\instituto_live\resources\views/editar_aula.blade.php ENDPATH**/ ?>