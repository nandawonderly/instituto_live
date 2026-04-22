

<?php $__env->startSection('conteudo'); ?>
<main class="content-area"> 
    <div class="header-acoes">
        <h2>Cursos Cadastrados</h2>
        <a href="/admin/cursos/novo" class="btn-submit" style="width: auto; padding: 10px 20px; text-decoration: none;">+ Novo Curso</a>
    </div>

    <div class="cursos-grid">
        <?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card-curso" style="border: 1px solid #eaeaea; padding: 20px; border-radius: 8px; margin-bottom: 15px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h3 style="color: #1c4a8a; margin-bottom: 5px;"><?php echo e($curso->nome); ?></h3>
                <p style="color: #666; font-size: 14px;"><?php echo e($curso->descricao); ?></p>
            </div style="display: flex; gap: 10px;">
            <form action="/admin/cursos/<?php echo e($curso->id); ?>" method="POST" onsubmit="return confirm('Apagar este curso apagará TUDO dentro dele. Tem certeza?');" 
            style="margin: 0; margin-left: auto; padding: 10px">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" style="background-color: #fee2e2; color: #991b1b; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: 500; font-size: 14px;">Excluir</button>
            </form>
            <a href="/admin/cursos/<?php echo e($curso->id); ?>" class="btn-editar" style="text-decoration: none; background-color: #1c4a8a; color: white; padding: 8px 15px;">Ver Disciplinas</a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ferna\Documents\site cintia curso\instituto_live\resources\views/gerenciar_cursos.blade.php ENDPATH**/ ?>