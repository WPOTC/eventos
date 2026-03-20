<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/DB/Database.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Controller/ParticipanteController.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Model/ParticipanteModel.php";
$pdo = getPDOConnection();
$participanteModel = new ParticipanteModel($pdo);
$ParticipanteController = new ParticipanteController($participanteModel);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kondo Eventos</title>
</head>
<body>
<header>
      
        <?php
            echo "<a href = 'View/Usuario/exibirUsuario.php'>Imagem</a>" . "Seja bem-vindo(a), " . htmlspecialchars($_SESSION['nome']) . "!"
        ?>
     
        </div>
</header>
    <a href="../../index.php" img src="img/logo-voltar.png"></a>></a>

    


<?php
if(isset($_GET['id'])){
    
    $id = $_GET['id'];
    $participante = $ParticipanteController->listarInformacoesParticipante($id);
    ?>

<div class="cadastrado">
    <form method="post">
    <label for="nome">Nome: </label>
    <input type="text" name="nome" value="<?=$participante['nome'];?>" required> <br>

    <label for="email">Email: </label>
    <input type="email" name="email" value="<?=$participante['email'];?>" required> <br>

    <label for="telefone">Telefone: </label>
    <input type="number" name="telefone" value="<?=$participante['telefone'];?>" required> <br>

    <label for="senha">Senha: </label>
    <input type="password" name="senha" value="<?=$participante['senha'];?>" required> <br>

    <input type="submit" value="Salvar" onclick="return confirm('Tem certeza?')">
</form></div>
</body>
</html>

<?php
}else{
    header('Location: perfilParticipante.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    

    $ParticipanteController->editarParticipante($nome , $email , $telefone , $senha , $id);

    header('Location: perfilParticipante.php');
}


?>