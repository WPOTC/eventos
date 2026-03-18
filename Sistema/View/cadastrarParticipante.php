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
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            <br>
            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" required>
            <br>
            <button type="submit">Cadastrar</button>
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

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];

   $cadastro = $participanteController -> cadastrarParticipante($nome,$email,$telefone,$senha);

  if($cadastro){
            $participanteController->loginParticipante($email,$senha);
            header('Location: ../../index.php');
        }else{
            echo "<script>alert('Email já cadastrado!');</script>";
        }
}

?>