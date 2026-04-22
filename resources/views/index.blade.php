<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Plataforma de Cursos</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body style="justify-content: center; align-items: center;">

<div class="login-container">
    <h2>Acesso à Plataforma</h2>
    
    @if($errors->any())
        <div class="erro" style="color: red; text-align: center; margin-bottom: 15px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ url('logar') }}">
        @csrf <div class="form-group">
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
</html>