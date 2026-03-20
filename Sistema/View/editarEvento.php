<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/DB/Database.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Controller/EventoController.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Model/EventoModel.php";
$pdo = getPDOConnection();
$eventoModel = new EventoModel($pdo);
$EventoController = new EventoController($eventoModel);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kondo Eventos</title>
</head>
<body>


<?php
if(isset($_GET['id'])){
    
    $id = $_GET['id'];
    $evento = $EventoController->listarInformacoesEvento($id);
    ?>

<div class="cadastrado">
    <form method="post">
    <label for="titulo">Título: </label>
    <input type="text" name="titulo" value="<?=$evento['titulo'];?>" required> <br>

    <label for="descricao">Descrição: </label>
    <input type="text" name="descricao" value="<?=$evento['descricao'];?>" required> <br>

    <label for="data">Data: </label>
    <input type="date" name="data" value="<?=$evento['data'];?>" required> <br>

    <label for="local">Local: </label>
    <input type="text" name="local" value="<?=$evento['local'];?>" required> <br>

    <label for="quant_participantes">Quantidade de participantes: </label>
    <input type="number" name="quant_participantes" value="<?=$evento['quant_participantes'];?>" min="<?= $evento['quant_participantes'] ?>" required> <br>

    <input type="submit" value="Salvar" onclick="return confirm('Tem certeza?')">
</form></div>
</body>
</html>

<?php
}else{
    header('Location: eventos.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data = $_POST['data'];
    $local = $_POST['local'];
    $quant_participantes = $_POST['quant_participantes'];

    $EventoController->editarEvento($titulo, $descricao, $data, $local, $quant_participantes, $id);

    header('Location: eventos.php');
}


?>