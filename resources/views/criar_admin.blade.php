<?php
// Importa a sua conexão com o banco de dados
require 'conexao.php';

// Dados do usuário que vamos criar
$nome = "Fernanda Admin";
$email = "admin@instituto.com";
$senha_normal = "123456"; // Essa é a senha que você vai digitar na tela de login
$tipo_perfil = "admin";

// Criptografa a senha do jeito que o seu sistema de login exige
$senha_criptografada = password_hash($senha_normal, PASSWORD_DEFAULT);

try {
    // Verifica se o e-mail já existe para não duplicar
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
    $stmt->execute(['email' => $email]);
    
    if ($stmt->rowCount() > 0) {
        echo "O usuário admin já existe no banco de dados!";
    } else {
        // Insere o usuário no banco de dados
        $sql = "INSERT INTO usuarios (nome, email, senha_hash, tipo_perfil) VALUES (:nome, :email, :senha, :perfil)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha_criptografada,
            'perfil' => $tipo_perfil
        ]);
        
        echo "<h2>Sucesso!</h2>";
        echo "<p>Administradora criada com sucesso.</p>";
        echo "<p><b>E-mail:</b> $email</p>";
        echo "<p><b>Senha:</b> $senha_normal</p>";
        echo '<br><a href="index.php">Clique aqui para ir para a tela de login</a>';
    }
} catch (PDOException $e) {
    echo "Erro ao criar usuário: " . $e->getMessage();
}
?>