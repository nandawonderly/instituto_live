<?php
// Importa a sua conexão com o banco de dados
require 'conexao.php';

// --- MUDE ESSES DADOS PARA CRIAR ALUNOS DIFERENTES ---
$nome = "João Aluno Teste";
$email = "joao.aluno@teste.com";
$senha_normal = "senha123"; // A senha que o aluno vai digitar
$tipo_perfil = "aluno"; // O perfil DEVE ser 'aluno'
// -----------------------------------------------------

// Criptografa a senha
$senha_criptografada = password_hash($senha_normal, PASSWORD_DEFAULT);

try {
    // Verifica se esse e-mail já foi cadastrado
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
    $stmt->execute(['email' => $email]);
    
    if ($stmt->rowCount() > 0) {
        echo "Esse e-mail já está cadastrado no sistema!";
    } else {
        // Insere o NOVO usuário no banco de dados (o admin continua lá intacto)
        $sql = "INSERT INTO usuarios (nome, email, senha_hash, tipo_perfil) VALUES (:nome, :email, :senha, :perfil)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha_criptografada,
            'perfil' => $tipo_perfil
        ]);
        
        echo "<h2>Sucesso!</h2>";
        echo "<p>Aluno criado com sucesso.</p>";
        echo "<p><b>E-mail:</b> $email</p>";
        echo "<p><b>Senha:</b> $senha_normal</p>";
        echo '<br><a href="index.php">Clique aqui para ir para a tela de login testar</a>';
    }
} catch (PDOException $e) {
    echo "Erro ao criar usuário: " . $e->getMessage();
}
?>