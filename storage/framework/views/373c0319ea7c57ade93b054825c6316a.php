

<?php $__env->startSection('conteudo'); ?>

<main class="content-area">
    <div class="header-acoes">
        <div>
            <a href="/admin/cursos/<?php echo e($disciplina->curso_id); ?>" class="btn-voltar">← Voltar para Curso</a>
            <h2 style="margin-top: 10px;">Disciplina: <?php echo e($disciplina->nome); ?></h2>
        </div>
        <a href="/admin/disciplinas/<?php echo e($disciplina->id); ?>/aulas/nova" class="btn-submit" style="width: auto; padding: 10px 20px; text-decoration: none;">+ Nova Aula</a>
    </div>

    <div class="lista-aulas" style="margin-top: 30px;">
        <h3>Aulas desta disciplina:</h3>
        <div style="margin-top: 15px;">
            <?php $__empty_1 = true; $__currentLoopData = $disciplina->aulas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aula): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div style="border: 1px solid #eaeaea; padding: 15px; border-radius: 8px; margin-bottom: 10px; display: flex; justify-content: space-between; align-items: flex-start;">
                
                <div>
                    <h4 style="color: #1c4a8a; margin-bottom: 10px;"><?php echo e($aula->titulo); ?></h4>
                    <?php if($aula->url_video): ?>
                        <span style="background: #fee2e2; color: #991b1b; padding: 3px 8px; border-radius: 4px; font-size: 12px; margin-right: 10px;">Vídeo Anexado</span>
                    <?php endif; ?>
                    <?php if($aula->materiais->count() > 0): ?>
                        <span style="background: #e0f2fe; color: #075985; padding: 3px 8px; border-radius: 4px; font-size: 12px;"><?php echo e($aula->materiais->count()); ?> Arquivo(s)</span>
                    <?php endif; ?>
                </div>

                <div style="display: flex; gap: 10px;">
                    <a href="/admin/aulas/<?php echo e($aula->id); ?>" class="btn-submit" style="text-decoration: none; font-size: 13px; width: auto; padding: 6px 12px;">Ver Aula</a>
                    <a href="/admin/aulas/<?php echo e($aula->id); ?>/editar" class="btn-editar" style="text-decoration: none; font-size: 13px;">Editar</a>
                    <form action="/admin/aulas/<?php echo e($aula->id); ?>" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta aula? Os arquivos também serão apagados.');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?> <button type="submit" style="background-color: #fee2e2; color: #991b1b; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer; font-weight: 500; font-size: 13px;">Excluir</button>
                    </form>
                </div>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p style="color: #999;">Nenhuma aula cadastrada ainda.</p>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ferna\Documents\site cintia curso\instituto_live\resources\views/detalhes_disciplina.blade.php ENDPATH**/ ?>