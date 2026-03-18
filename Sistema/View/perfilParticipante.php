<?php

require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Model/ParticipanteModel.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Controller/ParticipanteController.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/DB/Database.php";
$pdo = getPDOConnection();
$participanteModel = new ParticipanteModel($pdo);
$participanteController = new ParticipanteController($participanteModel);
session_start();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $participante = $participanteController->buscarParticipante($_SESSION['participante_id']);
   
}

?>
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
    
    <main>
    <h2>Perfil do Participante</h2>
    <p><strong>Nome:</strong> <?php echo $participante['nome']; ?></p>
    <p><strong>Email:</strong> <?php echo $participante['email']; ?></p>
    <p><strong>Telefone:</strong> <?php echo $participante['telefone']; ?></p>
    <p><strong>Eventos Inscritos:</strong> <?php echo $participante['id_eventos']; ?></p>
    
    </main>
      
</body>
</html>