<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kondo Eventos</title>
</head>
<body>

<header>
    <h1>Kondo Eventos</h1>
    <nav>
        <ul>
            <li><a href="../../index.php">Início</a></li>
            <li><a href="eventos.php">Eventos</a></li>
            <li><a href="../../sobre.php">Sobre</a></li>
        </ul>
    </nav>
</header>

<main>
    <form method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br>
        <button type="submit">Login</button>
    </form>
</main>
    
</body>
</html>

<?php

require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Controller/ParticipanteController.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Model/ParticipanteModel.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/DB/Database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = getPDOConnection();
    $participanteModel = new ParticipanteModel($pdo);
    $participanteController = new ParticipanteController($participanteModel);

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $participante = $participanteController->loginParticipante($email, $senha);
    if($participante == NULL){
        echo "<script>alert('Login ou senha incorretos!');</script>";
    } else {
        header('Location: ../../index.php');
        exit;
    }

}

?>