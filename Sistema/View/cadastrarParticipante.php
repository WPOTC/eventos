<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kondo Eventos</title>
    <link rel="stylesheet" href="../../css/cadastros.css">
</head>
<body>
    <header>
    <h1>Kondo Eventos</h1>
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
            <button type="submit" class="btn">Cadastrar</button>
        </form>
    </main><br>

    <p class="texto-a-parte">Já é cadastrado? <a href="loginParticipante.php">Faça login</a></p>
    
    <br><br>
        <footer>
    <div class="rodape">

        <div class="footer-top">
        <p>&copy; 2026 Kondo Eventos. Todos os direitos reservados.</p>
        </div>
        </div>

    </div>

    
</footer>
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