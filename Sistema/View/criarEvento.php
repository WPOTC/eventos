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
</header>

    <main>
        <form method="post">
            <label for="Titulo">Título: </label>
            <input type="text" id="Titulo" name="titulo" required>

            <label for="Descricao">Descrição: </label>
            <input type="text" id="Descricao" name="descricao" required>

            <label for="Data">Data: </label>
            <input type="datetime-local" id="Data" name="data" required>

            <label for="Local">Local: </label>
            <input type="text" id="Local" name="local" required>

            <label for="QuantidadeVagas">Quantidade de vagas: </label>
            <input type="number" id="QuantidadeVagas" name="quant_participantes" required>
            <input type="submit" value="Criar Evento">
        </form>
    </main>
    
</body>
</html>

<?php

require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Controller/EventoController.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Model/EventoModel.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/DB/Database.php";

$pdo = getPDOConnection();
$eventoModel = new EventoModel($pdo);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventoController = new EventoController($eventoModel);
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data = $_POST['data'];
    $local = $_POST['local'];
    $quant_participantes = $_POST['quant_participantes'];
    $eventoController->criarEvento($titulo, $descricao, $data, $local, $quant_participantes);
    header("Location: eventos.php");
    exit();
}

?>