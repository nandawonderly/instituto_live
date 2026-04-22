<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel da Administradora</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <header class="top-header">
        <div class="logo-area">
            <img src="{{ asset('imagens/logo.png') }}" alt="Logo Instituto Live" class="logo-img"> 
            <div class="logo-text">
                <img src="{{ asset('imagens/header.png') }}" alt="Instituto Live - Educação e Saúde Mental" class="header-texto-img">
            </div>
        </div>

        <div class="user-profile">
            <img src="{{ asset('imagens/user.webp') }}" alt="Foto Admin" class="profile-img">
            <span class="user-name">Admin</span>
        </div>
    </header>

    <div class="main-container">
        
        <nav class="sidebar">
            <ul>
                <li><a href="/admin"><i class="fa-solid fa-house"></i> Painel Principal</a></li>
                <li><a href="/admin/cursos"><i class="fa-solid fa-book-open"></i> Gerenciar Cursos</a></li>
                <li><a href="/admin/alunos"><i class="fa-solid fa-users"></i> Gerenciar Alunos</a></li>
                <li><a href="/admin/professores"><i class="fa-solid fa-user-tie"></i> Gerenciar Professores</a></li>
                
                <li class="logout"><a href="#" onclick="abrirModalSair(event)"><i class="fa-solid fa-power-off"></i> Sair</a></li>
            </ul>
        </nav>

        <main class="content-area">
        @yield('conteudo')
        </main>

    </div>
    <div id="modalSair" class="modal-overlay">
        <div class="modal-box">
            <h3>Sair do sistema?</h3>
            <p>Tem certeza que deseja encerrar sua sessão?</p>
            <div class="modal-buttons">
                <button class="btn-cancelar" onclick="fecharModalSair()">Não, voltar</button>
                <a href="/logout" class="btn-confirmar">Sim, sair</a>
            </div>
        </div>
    </div>

    <script>
        function abrirModalSair(event) {
            event.preventDefault(); // Impede que a página recarregue ao clicar no link
            document.getElementById('modalSair').style.display = 'flex';
        }

        function fecharModalSair() {
            document.getElementById('modalSair').style.display = 'none';
        }
    </script>

</body>
</html>