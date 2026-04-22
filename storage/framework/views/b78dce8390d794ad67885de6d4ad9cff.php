

<?php $__env->startSection('conteudo'); ?>
<main class="content-area">
    <div class="header-acoes">
        <div>
            <a href="/admin/cursos" class="btn-voltar">← Voltar para Lista de Cursos</a>
            <h2 style="margin-top: 10px;">Curso: <?php echo e($curso->nome); ?></h2>
        </div>
        <a href="/admin/cursos/<?php echo e($curso->id); ?>/disciplinas/nova" class="btn-submit" style="width: auto; padding: 10px 20px; text-decoration: none;">+ Nova Disciplina</a>
    </div>

    <div class="lista-disciplinas" style="margin-top: 30px;">
        <h3>Disciplinas deste Curso:</h3>
        <ul style="list-style: none; padding: 0; margin-top: 15px;">
            <?php $__empty_1 = true; $__currentLoopData = $curso->disciplinas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $disciplina): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li style="padding: 15px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <strong><?php echo e($disciplina->nome); ?></strong>
                        <p style="font-size: 13px; color: #666; margin-top: 5px;"><?php echo e($disciplina->descricao); ?></p>
                    </div>
                    <form action="/admin/disciplinas/<?php echo e($disciplina->id); ?>" method="POST" onsubmit="return confirm('Tem certeza que deseja apagar esta disciplina e TODAS as suas aulas?');"
                     style="margin: 0; margin-left: auto; padding: 10px">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" style="background-color: #fee2e2; color: #991b1b; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: 500; font-size: 14px;">Excluir</button>
                    </form>
                    <a href="/admin/disciplinas/<?php echo e($disciplina->id); ?>" class="btn-editar" style="text-decoration: none;">Ver Aulas</a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p style="color: #999; margin-top: 10px;">Nenhuma disciplina cadastrada para este curso ainda.</p>
            <?php endif; ?>
        </ul>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ferna\Documents\site cintia curso\instituto_live\resources\views/detalhes_curso.blade.php ENDPATH**/ ?>