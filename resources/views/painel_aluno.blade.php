<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Aluno</title>
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
            <img src="{{ asset('imagens/user.webp') }}" alt="Foto Aluno" class="profile-img">
            <span class="user-name">{{ $primeiro_nome }}</span>
        </div>
    </header>

    <div class="main-container">
        
        <nav class="sidebar">
            <ul>
                <li><a href="#"><i class="fa-solid fa-house"></i> Início</a></li>
                <li><a href="#"><i class="fa-solid fa-graduation-cap"></i> Meus Cursos</a></li>
                <li><a href="#"><i class="fa-solid fa-folder-open"></i> Meus Materiais</a></li>
                
                <li class="logout"><a href="#" onclick="abrirModalSair(event)"><i class="fa-solid fa-power-off"></i> Sair</a></li>
            </ul>
        </nav>

        <main class="content-area">
            <div class="greeting">
                <h2>Olá, {{ $primeiro_nome }}!</h2>
                <p>Bem-vindo(a) de volta à sua área de estudos. Continue de onde parou.</p>
            </div>

            <div class="cards-container">
                
                <div class="card card-curso">
                    <i class="fa-solid fa-play-circle card-icon"></i>
                    <h3>Módulo 1: Introdução</h3>
                    <p>Turma A - Acesse as vídeo-aulas e arquivos base desta disciplina.</p>
                    <button><i class="fa-solid fa-video"></i> Assistir Aulas</button>
                </div>

                <div class="card card-curso">
                    <i class="fa-solid fa-file-pdf card-icon"></i>
                    <h3>Materiais de Apoio</h3>
                    <p>Baixe os arquivos em PDF e exercícios referentes às aulas.</p>
                    <button><i class="fa-solid fa-download"></i> Baixar Arquivos</button>
                </div>

                 <div class="card card-curso">
                    <i class="fa-solid fa-check-circle card-icon"></i>
                    <h3>Módulo 2: Avançado</h3>
                    <p>Turma A - Aulas complementares e materiais de revisão.</p>
                    <button><i class="fa-solid fa-video"></i> Assistir Aulas</button>
                </div>

            </div>
        </main>

    </div>

    <div id="modalSair" class="modal-overlay">
        <div class="modal-box">
            <h3>Sair da Plataforma?</h3>
            <p>Tem certeza que deseja encerrar sua sessão de estudos?</p>
            <div class="modal-buttons">
                <button class="btn-cancelar" onclick="fecharModalSair()">Não, voltar</button>
                <a href="/logout" class="btn-confirmar">Sim, sair</a>
            </div>
        </div>
    </div>

    <script>
        function abrirModalSair(event) {
            event.preventDefault();
            document.getElementById('modalSair').style.display = 'flex';
        }

        function fecharModalSair() {
            document.getElementById('modalSair').style.display = 'none';
        }
    </script>

</body>
</html>