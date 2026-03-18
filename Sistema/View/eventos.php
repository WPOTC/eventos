<?php

require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Controller/EventoController.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Model/EventoModel.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/DB/Database.php";

$pdo = getPDOConnection();
$eventoModel = new EventoModel($pdo);
$eventoController = new EventoController($eventoModel);
$eventos = $eventoController->listarEventos();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kondo Eventos</title>
</head>
<?php
session_start();
?>
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
    <img src="../../img/user.png" alt="Imagem do usuário" width="50" height="50">
     <?php
    if (isset($_SESSION['participante_id'])) {
        echo "<a href='perfilParticipante.php'>Bem-vindo(a), " . $_SESSION['nome'] . "!</a>";
    } elseif(!isset($_SESSION['participante_id'])){
        echo "<a href='cadastrarParticipante.php'>Cadastre-se</a> ou <a href='loginParticipante.php'>Faça login</a>";
    }
    ?>
</header>

<main>
    <section>
        <h2>Eventos</h2>
        <p>Aqui você pode encontrar todos os eventos organizados pela Kondo Eventos. Explore as opções e participe dos eventos que mais lhe interessam! Ou, se preferir, <a href="criarEvento.php">crie seu próprio evento</a>.</p>
    </section>



    <?php
      if(empty($eventos)){
        echo "<p>Não há eventos disponíveis no momento. Por favor, volte mais tarde.</p>";
      }elseif(!empty($eventos)){
        foreach ($eventos as $evento){
        $vagasOcupadas = $evento['vagas_ocupadas'];
        $vagasDisponiveis = $evento['quant_participantes'] - $vagasOcupadas;
            echo "<div class='evento'>";
            echo "<h3>" . htmlspecialchars($evento['titulo']) . "</h3>";
            echo "<p>" . htmlspecialchars($evento['descricao']) . "</p>";
            echo "<p><strong>Data:</strong> " . htmlspecialchars($evento['data']) . "</p>";
            echo "<p><strong>Local:</strong> " . htmlspecialchars($evento['local']) . "</p>";
            echo "<p><strong>Quantidade de vagas disponíveis:</strong> " . htmlspecialchars($vagasDisponiveis) . "</p>";
            echo "<p><strong>Participante:</strong> " . htmlspecialchars($evento['id_participantes']) . "</p>";
            if ($vagasDisponiveis > 0) {
                echo "<button>Participar</button>";
            } else {
                echo "<p><em>Evento lotado</em></p>";
            }
            echo "</div>";
        }
           require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Model/ParticipanteModel.php";
           require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Controller/ParticipanteController.php";
           $participanteModel = new ParticipanteModel($pdo);
           $participanteController = new ParticipanteController($participanteModel);

           $participanteController->participarEvento($_SESSION['nome'], $evento['id']);
      }
    ?>

    
</body>
</html>