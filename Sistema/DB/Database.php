<?php

$dsn = 'mysql:host=localhost;dbname=org_eventos;charset=utf8';
$usuario = 'root';
$senha = '';

global $pdo;


try{
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Erro" . $e->getMessage();
    } 
    
    return $pdo;

    ?>