<?php
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Controller/EventoController.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Model/EventoModel.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/DB/Database.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Model/InscricoesModel.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Controller/InscricoesController.php";

session_start();

$pdo = getPDOConnection();
$eventoModel = new EventoModel($pdo);
$eventoController = new EventoController($eventoModel);
$eventos = $eventoController->listarEventos();

$inscricoesModel = new InscricoesModel($pdo);
$inscricoesController = new InscricoesController($inscricoesModel);

// Verifica se o participante está logado e trata o POST antes de qualquer saída
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_evento = $_POST['id_evento'];
    $id_participante = $_SESSION['participante_id'] ?? null;
    if (isset($_SESSION['participante_id'])) {
        $inscricoesController->participarEvento($id_participante, $id_evento);
        header('Location: eventos.php');
        exit;
    } else {
        echo "<script>alert('Faça login para se inscrever no evento!');</script>";
        header('Location: loginParticipante.php');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kondo Eventos</title>
</head>
<link rel="stylesheet" href="../../css/eventos.css">

<body>

   <header>
    <div class="header1">
    <h1>Kondo Eventos</h1>
    <nav>
        <ul>
            <li><a href="../../index.php">Início</a></li>
            <li><a href="Sistema/View/eventos.php">Eventos</a></li>
            <li><a href="../../sobre.php">Sobre</a></li>
        </ul>
    </nav>
</div>
    <div class="header2">
     <?php
    if (isset($_SESSION['participante_id'])) {
        echo "<p><a href='Sistema/View/perfilParticipante.php?id=" . $_SESSION['participante_id'] . "'>Bem-vindo(a), " . $_SESSION['nome'] . "!</a></p>";
    } elseif(!isset($_SESSION['participante_id'])){
        echo "<p><a href='Sistema/View/cadastrarParticipante.php'>Cadastre-se</a></p> <p>ou</p> <p><a href='Sistema/View/loginParticipante.php'>Faça login</a></p>";
    }
    ?>
    </div>
</header>

    <main>
        <section class="secao">
            <h2>Eventos</h2>
            <p>Aqui você pode encontrar todos os eventos organizados pela Kondo Eventos. Explore as opções e participe dos eventos que mais lhe interessam! Ou, se preferir, <a href="criarEvento.php">crie seu próprio evento</a>.</p>
        </section> <br><br>



        <?php
        if (empty($eventos)) {
            echo "<p>Não há eventos disponíveis no momento. Por favor, volte mais tarde.</p>";
        } elseif (!empty($eventos)) {
            foreach ($eventos as $evento) {
                $vagasDisponiveis = $evento['quant_participantes'] - $evento['vagas_ocupadas'];
                echo "<div class='evento'>";
                echo "<h3 class='titulo-evento'>" . htmlspecialchars($evento['titulo']) . "</h3>";
                echo "<p class='descricao-evento'>" . htmlspecialchars($evento['descricao']) . "</p>";
                echo "<p><strong>Data:</strong> " . htmlspecialchars($evento['data']) . "</p>";
                echo "<p><strong>Local:</strong> " . htmlspecialchars($evento['local']) . "</p>";
                echo "<p><strong>Quantidade de vagas disponíveis:</strong> " . htmlspecialchars($vagasDisponiveis) . "</p>";
                echo "<p><strong>Participantes inscritos:</strong> ";
                $inscricoes = $inscricoesController->listarParticipantesPorEvento($evento['id']);
                foreach ($inscricoes as $inscricao) {
                    echo htmlspecialchars($inscricao['nome']) . "; ";
                }
                echo "</p>";

                if ($vagasDisponiveis > 0) {
                    echo "<form method='POST'>";
                    echo "<input type='hidden' name='id_evento' value='" . ($evento['id']) . "'>";
                    echo "<input type='submit' value='Participar' class='btn-participar'>";
                    echo "</form>";
                } elseif ($vagasDisponiveis == 0) {
                    echo "<p><em>Evento lotado</em></p>";
                }
                if (isset($_SESSION['email']) && $_SESSION['email'] == 'adm@gmail.com') {
                    echo "<a href='editarEvento.php?id=" . $evento['id'] . "'>Editar Evento</a>";
                    echo "<a href='BEpages/deletarEvento.php?id=" . $evento['id'] . "' onclick='return confirm(\"Tem certeza que deseja excluir este evento?\")'>Excluir Evento</a>";
                }
                echo "</div>";
                echo "<br>";
            }
        }


        // Verifica se o participante está logado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_evento = $_POST['id_evento'];
            $id_participante = $_SESSION['participante_id'] ?? null;
            if (isset($_SESSION['participante_id'])) {
                $inscricoesController->participarEvento($id_participante, $id_evento);
                header('Location: eventos.php');
                exit;
            } elseif(!isset($_SESSION['participante_id'])) {
                echo "<script>alert('Faça login para se inscrever no evento!');</script>";
                header('Location: loginParticipante.php');
                exit;
            }
        }
        ?>

    </main>


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