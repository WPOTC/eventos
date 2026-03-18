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
            <li><a href="Sistema/View/eventos.php">Eventos</a></li>
            <li><a href="sobre.php">Sobre</a></li>
        </ul>
    </nav>
    <img src="img/user.png" alt="Imagem do usuário" width="50" height="50">
     <?php
    if (isset($_SESSION['participante_id'])) {
        echo "<a href='Sistema/View/perfilParticipante.php'>Bem-vindo(a), " . $_SESSION['nome'] . "!</a>";
    } elseif(!isset($_SESSION['participante_id'])){
        echo "<a href='Sistema/View/cadastrarParticipante.php'>Cadastre-se</a> ou <a href='Sistema/View/loginParticipante.php'>Faça login</a>";
    }
    ?>
</header>

<main>
    <section>
        <h2>Bem-vindo à Kondo Eventos!</h2>
        <p>
            A <strong>Kondo Eventos</strong> nasceu inspirada nos ensinamentos da renomada socióloga japonesa Marie Kondo, referência mundial em organização e minimalismo. Assim como ela acredita que a organização pode transformar vidas, nós acreditamos que a organização transforma eventos em experiências inesquecíveis.
        </p>
        <p>
            Com mais de 10 anos de atuação, oferecemos soluções completas para eventos corporativos, sociais, culturais e esportivos. Nossa missão é criar momentos marcantes, organizados com carinho, eficiência e atenção aos detalhes, para que cada cliente viva seu evento com alegria e tranquilidade.
        </p>
        <h3>Nossos Valores</h3>
        <ul>
            <li><strong>Organização:</strong> Cada detalhe é planejado para garantir harmonia e fluidez em todos os momentos.</li>
            <li><strong>Respeito:</strong> Valorizamos a diversidade, a cultura e as necessidades de cada cliente.</li>
            <li><strong>Inovação:</strong> Buscamos sempre novas ideias e tendências para surpreender e encantar.</li>
            <li><strong>Comprometimento:</strong> Cumprimos prazos, orçamentos e superamos expectativas.</li>
            <li><strong>Paixão:</strong> Amamos o que fazemos e transmitimos isso em cada evento realizado.</li>
        </ul>
        <h3>Missão</h3>
        <p>
            Proporcionar experiências únicas por meio da organização impecável de eventos, tornando cada ocasião memorável e significativa.
        </p>
        <h3>Visão</h3>
        <p>
            Ser reconhecida como a empresa de eventos mais organizada, criativa e confiável do Brasil, inspirando pessoas a celebrarem com alegria e leveza.
        </p>
        <h3>O que fazemos por você?</h3>
        <ul>
            <li>Consultoria e planejamento personalizado</li>
            <li>Gestão completa de fornecedores</li>
            <li>Decoração temática e inovadora</li>
            <li>Buffet variado e de alta qualidade</li>
            <li>Equipe de cerimonial experiente</li>
            <li>Suporte tecnológico e audiovisual</li>
            <li>Logística e coordenação no dia do evento</li>
        </ul>
        <h3>Depoimentos</h3>
        <blockquote>
            "A Kondo Eventos organizou nosso casamento com tanto carinho e perfeição que superou todas as nossas expectativas!"<br>
            <em>- Ana e Rafael</em>
        </blockquote>
        <blockquote>
            "Nunca vi um evento corporativo tão bem planejado. Tudo fluiu perfeitamente!"<br>
            <em>- Carlos, CEO da TechNow</em>
        </blockquote>
        <p>
            <strong>Pronto para organizar um evento que realmente desperte alegria?</strong> Entre em contato conosco e descubra como a Kondo Eventos pode transformar sua celebração em um momento inesquecível!
        </p>
    </section>
</main>
    
</body>
</html>