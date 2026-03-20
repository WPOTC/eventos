<?php
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/DB/Database.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Controller/ParticipanteController.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Model/ParticipanteModel.php";
$pdo = getPDOConnection();
$participanteModel = new ParticipanteModel($pdo);
$ParticipanteController = new ParticipanteController($participanteModel);

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $participante = $ParticipanteController->deletarParticipante($id);
    header('Location: logoutParticipante.php');
}else{
    header('Location: logoutParticipante.php');
}




?>