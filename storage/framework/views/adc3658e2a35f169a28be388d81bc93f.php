<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Plataforma de Cursos</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>

<div class="login-container">
    <h2>Acesso à Plataforma</h2>
    
    <?php if($errors->any()): ?>
        <div class="erro" style="color: red; text-align: center; margin-bottom: 15px;">
            <?php echo e($errors->first()); ?>

        </div>
    <?php endif; ?>

    <form method="POST" action="/logar">
        <?php echo csrf_field(); ?> <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required placeholder="Digite seu e-mail">
        </div>
        
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required placeholder="Digite sua senha">
        </div>
        
        <button type="submit">Entrar</button>
    </form>
</div>

</body>
</html><?php /**PATH C:\Users\ferna\Documents\site cintia curso\instituto_live\resources\views/login.blade.php ENDPATH**/ ?>