

<?php $__env->startSection('conteudo'); ?>
<main class="content-area">
    <div class="header-acoes">
        <h2>🎓 Gerenciar Alunos</h2>
        <p>Matricule novos alunos e vincule-os aos seus respectivos cursos.</p>
    </div>

    <div class="form-container" style="margin-top: 20px;">
        <form action="/admin/alunos" method="POST">
            <?php echo csrf_field(); ?>
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; align-items: end;">
                <div class="form-group" style="margin:0;">
                    <label>Nome do Aluno:</label>
                    <input type="text" name="name" required placeholder="Nome Completo">
                </div>
                <div class="form-group" style="margin:0;">
                    <label>E-mail:</label>
                    <input type="email" name="email" required placeholder="email@exemplo.com">
                </div>
                <div class="form-group" style="margin:0;">
                    <label>Curso:</label>
                    <select name="curso_id" required style="width: 100%; padding: 10px;">
                        <option value="">Selecione o Curso</option>
                        <?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($curso->id); ?>"><?php echo e($curso->nome); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <small style="color: #666; display: block; margin-top: 5px;">A senha padrão será <strong>senha123</strong></small>
            </div>
            <button type="submit" class="btn-submit" style="margin-top: 20px; width: 200px;">Matricular Aluno</button>
        </form>
    </div>

    <div class="form-container" style="margin-top: 30px;">
        <h3>Lista de Alunos Matriculados</h3>
        <table style="width: 100%; margin-top: 20px; border-collapse: collapse;">
            <thead>
                <tr style="text-align: left; border-bottom: 2px solid #eee;">
                    <th style="padding: 10px;">Nome</th>
                    <th style="padding: 10px;">Curso</th>
                    <th style="padding: 10px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $alunos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aluno): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px;"><?php echo e($aluno->name); ?></td>
                    <td style="padding: 10px;">
                        <span style="background: #e3f2fd; color: #0d47a1; padding: 4px 10px; border-radius: 15px; font-size: 12px;">
                            <?php echo e($aluno->curso->nome ?? 'Sem curso'); ?>

                        </span>
                    </td>
                    <td style="padding: 10px;">
                        <form action="/admin/alunos/<?php echo e($aluno->id); ?>" method="POST" onsubmit="return confirm('Excluir matrícula?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" style="color: red; background: none; border: none; cursor: pointer;">Remover</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ferna\Documents\site cintia curso\instituto_live\resources\views/gerenciar_aluno.blade.php ENDPATH**/ ?>