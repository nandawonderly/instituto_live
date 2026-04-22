

<?php $__env->startSection('conteudo'); ?>

<main class="content-area">
    <div class="header-acoes">
        <div>
            <h2>🎯 Criar Quiz: <?php echo e($aula->titulo); ?></h2>
            <p>Questões já cadastradas: <strong><?php echo e($aula->questoes->count()); ?></strong></p>
        </div>
    </div>

    <?php if(session('sucesso')): ?>
        <div style="background: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
            <?php echo e(session('sucesso')); ?>

        </div>
    <?php endif; ?>

    <div class="form-container" style="margin-top: 20px;">
        <form method="POST" action="/admin/aulas/<?php echo e($aula->id); ?>/quiz">
            <?php echo csrf_field(); ?>
            
            <div class="form-group">
                <label for="enunciado">Enunciado da Questão:</label>
                <textarea id="enunciado" name="enunciado" rows="3" required placeholder="Ex: Qual o resultado de 2+2?"></textarea>
            </div>

            <div class="form-group">
                <label>Alternativas:</label>
                <?php $__currentLoopData = ['A', 'B', 'C']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $letra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                    <input type="radio" name="correta" value="<?php echo e($index); ?>" required>
                    <input type="text" name="alternativas[]" placeholder="Opção <?php echo e($letra); ?>" required style="flex: 1;">
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <a href="/admin/disciplinas/<?php echo e($aula->disciplina_id); ?>" style="color: #666; text-decoration: none;">
                    Sair sem salvar esta questão
                </a>
            </div>
        </form>
    </div>

    <?php if($aula->questoes->count() > 0): ?>
    <div class="form-container" style="margin-top: 40px; background: #f8f9fa;">
        <h4>Questões já adicionadas:</h4>
        <ul style="margin-top: 10px; list-style: none; padding: 0;">
            <?php $__currentLoopData = $aula->questoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li style="padding: 10px; border-bottom: 1px solid #ddd;">
                    <strong><?php echo e($loop->iteration); ?>.</strong> <?php echo e($q->enunciado); ?>

                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>
</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ferna\Documents\site cintia curso\instituto_live\resources\views/adicionar_quiz.blade.php ENDPATH**/ ?>