<?php

require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Model/ParticipanteModel.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Controller/ParticipanteController.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Model/InscricoesModel.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Controller/InscricoesController.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/DB/Database.php";
$pdo = getPDOConnection();
$participanteModel = new ParticipanteModel($pdo);
$participanteController = new ParticipanteController($participanteModel);
$inscricoesModel = new InscricoesModel($pdo);
$inscricoesController = new InscricoesController($inscricoesModel);
session_start();


if(isset($_GET['id'])){
    $id = $_GET['id'];
   
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kondo Eventos</title>
    <link rel="stylesheet" href="../../css/perfil.css">
</head>
<body>

<header>
    <div class="header1">
    <h1>Kondo Eventos</h1>
    <nav>
        <ul>
            <li><a href="../../index.php">Início</a></li>
            <li><a href="eventos.php">Eventos</a></li>
            <li><a href="../../sobre.php">Sobre</a></li>
        </ul>
    </nav>
    </div>

    <div class="header2">
     <?php
        echo "<p><a href='perfilParticipante.php?id=" . $_SESSION['participante_id'] . "'>Bem-vindo(a), " . $_SESSION['nome'] . "!</a></p>";
    ?>
    </div>
</header>
    
    <main>
    <h2>Perfil do Participante</h2>
    <?php $participante = $participanteController->listarInformacoesParticipante($_SESSION['participante_id']); ?>
    <p><strong>Nome:</strong> <?php echo $participante['nome']; ?></p>
    <p><strong>Email:</strong> <?php echo $participante['email']; ?></p>
    <p><strong>Telefone:</strong> <?php echo $participante['telefone']; ?></p>
    <p><strong>Senha:</strong> <?php echo $participante['senha']; ?></p>
    <p><strong>Eventos Inscritos:</strong></p>
    <?php
    $inscricoes = $inscricoesController->listarEventosPorParticipante($_SESSION['participante_id']);
                foreach ($inscricoes as $inscricao) {
                    echo htmlspecialchars($inscricao['titulo']) . "<br>";
                }

    ?>
    <br>
    <button class="btn"><a href="editarPerfil.php?id=<?php echo $_SESSION['participante_id']; ?>">Editar Perfil</a></button>
    <button class="btn"><a href="BEpages/logoutParticipante.php" onclick="return confirm('Tem certeza?')">Sair</a></button>
    <button class="btn"><a href="BEpages/deletarParticipante.php?id=<?php echo $_SESSION['participante_id']; ?>" onclick="return confirm('Tem certeza?')">Deletar Conta</a></button>
    </main>
    <br><br><br><br><br>

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