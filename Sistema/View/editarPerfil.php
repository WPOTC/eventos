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
    <link rel="stylesheet" href="../../css/cadastros.css">
</head>
<body>
      
    <header>
    <h1>Kondo Eventos</h1>
</header>


<?php
if(isset($_GET['id'])){
    
    $id = $_GET['id'];
    $participante = $ParticipanteController->listarInformacoesParticipante($id);
    ?>
<main>
    <form method="post">
    <label for="nome">Nome: </label>
    <input type="text" name="nome" value="<?=$participante['nome'];?>" required> <br>

    <label for="email">Email: </label>
    <input type="email" name="email" value="<?=$participante['email'];?>" required> <br>

    <label for="telefone">Telefone: </label>
    <input type="number" name="telefone" value="<?=$participante['telefone'];?>" required> <br>

    <label for="senha">Senha: </label>
    <input type="password" name="senha" value="<?=$participante['senha'];?>" required> <br>

    <button type="submit" onclick="return confirm('Tem certeza?')" class="btn">Salvar</button>
</form>
</main><br><br><br><br><br>

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