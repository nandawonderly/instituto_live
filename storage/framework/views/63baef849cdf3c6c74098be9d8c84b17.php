

<?php $__env->startSection('conteudo'); ?>

<main class="content-area">
    <div class="header-acoes">
        <div>
            <a href="/admin/cursos/<?php echo e($curso->id); ?>" class="btn-voltar">Voltar para Curso</a>
            <h2 style="margin-top: 10px;">Nova Disciplina em: <?php echo e($curso->nome); ?></h2>
        </div>
    </div>

    <div class="form-container" style="margin-top: 20px;">
        <form action="/admin/cursos/<?php echo e($curso->id); ?>/disciplinas" method="POST">
            <?php echo csrf_field(); ?>
            
            <div class="form-group">
                <label for="nome_disciplina">Nome da Disciplina:</label>
                <input type="text" id="nome_disciplina" name="nome" required placeholder="Ex: Anatomia Básica">
            </div>

            <div class="form-group">
                <label for="descricao_disciplina">Descrição da Disciplina:</label>
                <textarea id="descricao_disciplina" name="descricao" rows="3" placeholder="Resumo do que será ensinado..."></textarea>
            </div>

            <button type="submit" class="btn-submit">Salvar Disciplina</button>
        </form>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ferna\Documents\site cintia curso\instituto_live\resources\views/criar_disciplina.blade.php ENDPATH**/ ?>