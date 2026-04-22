<?php
$host = 'localhost';
$dbname = 'lms_professora'; 
$usuario = 'root'; 
$senha = 'iLuvpasta0'; // Coloque a senha do seu MySQL Workbench aqui

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>