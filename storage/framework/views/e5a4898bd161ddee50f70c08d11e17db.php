<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Professor</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">

    
</head>
<body>

    <header class="top-header">
        <div class="logo-area">
            <img src="<?php echo e(asset('imagens/logo.png')); ?>" alt="Logo Instituto Live" class="logo-img"> 
            <div class="logo-text">
                <img src="<?php echo e(asset('imagens/header.png')); ?>" alt="Instituto Live - Educação e Saúde Mental" class="header-texto-img">
            </div>
        </div>

        <div class="user-profile">
            <img src="<?php echo e(asset('imagens/user.webp')); ?>" alt="Foto Professor" class="profile-img">
            <span class="user-name">Prof. <?php echo e($primeiro_nome); ?></span>
        </div>
    </header>

    <div class="main-container">
        
        <nav class="sidebar">
            <ul>
                <li><a href="#"><i class="fa-solid fa-house"></i> Início</a></li>
                <li><a href="#"><i class="fa-solid fa-users-rectangle"></i> Minhas Turmas</a></li>
                <li><a href="#"><i class="fa-solid fa-cloud-arrow-up"></i> Adicionar Material</a></li>
                
                <li class="logout"><a href="#" onclick="abrirModalSair(event)"><i class="fa-solid fa-power-off"></i> Sair</a></li>
            </ul>
        </nav>

        <main class="content-area">
            
            <div class="form-container">
                <h2 class="form-title">Adicionar Materiais à Aula</h2>
                
                <form action="processar_upload.php" method="POST" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label>Título da Aula:</label>
                        <input type="text" name="titulo_aula" placeholder="Digite o título da aula" required>
                    </div>

                    <div class="form-group">
                        <label>Link do Vídeo do YouTube:</label>
                        <input type="url" name="link_youtube" placeholder="Cole o link do vídeo do YouTube aqui">
                    </div>

                    <div class="upload-box" id="drop-area">
                        <i class="fa-solid fa-cloud-arrow-up upload-icon"></i>
                        <p class="upload-text">Arraste e solte arquivos aqui ou clique em <strong>"Selecionar Arquivos"</strong></p>
                        
                        <input type="file" id="arquivoInput" name="arquivo_aula" accept=".pdf, .ppt, .pptx" hidden>
                        
                        <button type="button" class="btn-selecionar" onclick="document.getElementById('arquivoInput').click()">
                            Selecionar Arquivos
                        </button>
                        
                        <span class="file-formats">PDFs, slides (pptx)</span>
                    </div>

                    <div class="file-list" id="file-list-display" style="display: none;">
                        <div class="file-info">
                            <i class="fa-regular fa-file-pdf icon-pdf"></i>
                            <span id="nome-do-arquivo">material_de_introducao.pdf</span>
                        </div>
                        <i class="fa-solid fa-trash-can icon-trash" onclick="removerArquivo()" title="Remover arquivo"></i>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-enviar">Enviar</button>
                    </div>

                </form>
            </div>

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
        // Lógica do Modal de Sair
        function abrirModalSair(event) {
            event.preventDefault();
            document.getElementById('modalSair').style.display = 'flex';
        }
        function fecharModalSair() {
            document.getElementById('modalSair').style.display = 'none';
        }

        // Lógica para mostrar o nome do arquivo selecionado na tela
        const arquivoInput = document.getElementById('arquivoInput');
        const fileListDisplay = document.getElementById('file-list-display');
        const nomeDoArquivoSpan = document.getElementById('nome-do-arquivo');

        arquivoInput.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
                // Pega o nome do arquivo que a pessoa escolheu do computador
                const nome = this.files[0].name;
                nomeDoArquivoSpan.textContent = nome;
                
                // Mostra a barrinha inferior com o ícone de lixeira
                fileListDisplay.style.display = 'flex';
            }
        });

        // Lógica para o ícone da lixeira limpar a seleção
        function removerArquivo() {
            arquivoInput.value = ""; // Limpa o input
            fileListDisplay.style.display = 'none'; // Esconde a barrinha
        }
    </script>

</body>
</html><?php /**PATH C:\Users\ferna\Documents\site cintia curso\instituto_live\resources\views/painel_professor.blade.php ENDPATH**/ ?>