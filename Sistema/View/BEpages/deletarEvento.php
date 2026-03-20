<?php
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/DB/Database.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Controller/EventoController.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Model/EventoModel.php";
$pdo = getPDOConnection();
$eventoModel = new EventoModel($pdo);
$EventoController = new EventoController($eventoModel);

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $evento = $EventoController->deletarEvento($id);
    header('Location: ../eventos.php');
}else{
    header('Location: ../eventos.php');
}




?>