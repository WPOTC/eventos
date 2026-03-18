<?php
function getPDOConnection() {
    $dsn = 'mysql:host=localhost;dbname=org_eventos;charset=utf8';
    $usuario = 'root';
    $senha = '';
    try {
        $pdo = new PDO($dsn, $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    }
}