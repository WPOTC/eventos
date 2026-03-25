<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kondo Eventos</title>
    <link rel="stylesheet" href="css/sobre.css">
</head>
<?php
session_start();
?>
<body>

<header>
    <div class="header1">
    <h1>Kondo Eventos</h1>
    <nav>
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="Sistema/View/eventos.php">Eventos</a></li>
            <li><a href="sobre.php">Sobre</a></li>
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
    <section class="secao-sobre">
        <h1>Sobre a Kondo Eventos</h1>

        <p>
            A Kondo Eventos é uma empresa especializada na organização e planejamento de eventos que une técnica, sensibilidade e propósito. Inspirada na filosofia de organização e bem-estar, nossa atuação vai além da execução: buscamos criar experiências que transmitam leveza, harmonia e significado.
        </p>

        <p>
            Desde a nossa fundação, entendemos que cada evento carrega uma história única. Por isso, trabalhamos de forma personalizada, respeitando a identidade, os sonhos e os objetivos de cada cliente. Seja um casamento, evento corporativo, celebração social ou projeto cultural, nossa equipe se dedica a transformar ideias em momentos inesquecíveis.
        </p>
    </section><br>

    <section class="secao-historia">
        <h2>Nossa História</h2>

        <p>
            Com mais de uma década de experiência no mercado, a Kondo Eventos nasceu com o propósito de revolucionar a forma como os eventos são planejados. Inspirados pela filosofia do minimalismo e da organização consciente, construímos uma trajetória baseada na excelência, no cuidado com os detalhes e na busca constante por inovação.
        </p>

        <p>
            Ao longo dos anos, conquistamos a confiança de diversos clientes e parceiros, consolidando nossa reputação como uma empresa comprometida com qualidade, eficiência e resultados que superam expectativas.
        </p>
    </section>

    <section class="secao-diferenciais">
        <h2>Nossos Diferenciais</h2>

        <ul>
            <li>Atendimento personalizado e próximo ao cliente</li>
            <li>Planejamento estratégico e detalhado</li>
            <li>Equipe qualificada e experiente</li>
            <li>Parcerias com fornecedores confiáveis</li>
            <li>Soluções criativas e inovadoras</li>
            <li>Compromisso com prazos e excelência na execução</li>
        </ul>
    </section>

    <section class="secao-equipe">
        <h2>Nossa Equipe</h2>

        <p>
            Nossa equipe é formada por profissionais apaixonados pelo que fazem, com experiência em diversas áreas da organização de eventos. Trabalhamos de forma integrada para garantir que cada etapa do processo seja conduzida com eficiência, criatividade e atenção aos mínimos detalhes.
        </p>

        <p>
            Acreditamos que o sucesso de um evento está na união entre planejamento e emoção — e é exatamente isso que buscamos entregar em cada projeto.
        </p>
    </section>

    <section class="secao-compromisso">
        <h2>Nosso Compromisso</h2>

        <p>
            Na Kondo Eventos, nosso compromisso é proporcionar tranquilidade aos nossos clientes, cuidando de cada detalhe para que eles possam aproveitar seus momentos especiais sem preocupações. Trabalhamos com transparência, responsabilidade e dedicação, garantindo uma experiência completa do início ao fim.
        </p>

        <p>
            Mais do que organizar eventos, queremos criar memórias que despertem alegria e permaneçam para sempre.
        </p>
    </section>
</main>
    <br><br><br><br>


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