 <?php $__env->startSection('conteudo'); ?>
    <div class="content-area">
        <div class="greeting">
            <h2>Bem-vinda, Administradora!</h2>
            <p>Gerencie suas turmas, alunos e professores de forma fácil e intuitiva.</p>
        </div>

        <div class="cards-container">
            
            <div class="card card-blue">
                <img src="imagens/cursos.png" alt="" class="card-img-placeholder">
                <h3>Gerenciar Cursos</h3>
                <ul>
                    <li>Criar e editar turmas</li>
                    <li>Adicionar disciplinas</li>
                    <li>Gerenciar materiais do curso</li>
                </ul>
                <button><a href="/admin/cursos">Gerenciar Cursos</a></button>
            </div>

            <div class="card card-green">
                <img src="imagens/alunos.png" alt="" class="card-img-placeholder">
                <h3>Gerenciar Alunos</h3>
                <ul>
                    <li>Cadastrar alunos</li>
                    <li>Adicionar a turmas</li>
                    <li>Gerenciar lista de alunos</li>
                </ul>
                <button><a href="/admin/alunos">Gerenciar Alunos</a></button>
            </div>

            <div class="card card-orange">
                <img src="imagens/professor.png" alt="" class="card-img-placeholder">
                <h3>Gerenciar Professores</h3>
                <ul>
                    <li>Cadastrar professores</li>
                    <li>Atribuir a turmas</li>
                    <li>Gerenciar lista de professores</li>
                </ul>
                <button><a href="/admin/professores">Gerenciar Professores</a></button>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ferna\Documents\site cintia curso\instituto_live\resources\views/painel_admin.blade.php ENDPATH**/ ?>