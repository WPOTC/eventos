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
            <li><a href="index.php">Início</a></li>
            <li><a href="Sistema/View/eventosListados.php">Eventos</a></li>
            <li><a href="sobre.php">Sobre</a></li>
        </ul>
    </nav>
    <img src="img/user.png" alt="Imagem do usuário" width="50" height="50">
     <?php
    if (isset($_SESSION['participante_id'])) {
        echo "Bem-vindo(a), " . $_SESSION['nome'] . "!";
    } elseif(!isset($_SESSION['participante_id'])){
        echo "<a href='Sistema/View/cadastroParticipante.php'>Cadastre-se</a> ou <a href='Sistema/View/loginParticipante.php'>Faça login</a>";
    }
    ?>
</header>
    
</body>
</html>