<?php
	if(isset($_SESSION['email']))
		require("./assets/html/menulogado.php");
	else
		require("./assets/html/menusemlogin.php");
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quem Somos</title>
        <link rel="stylesheet" href="assets/css/quem_somos.css">
</head>
<body>
    <header class="header">
        <div class="header-content">
            <h1>Quem Somos</h1>
            <p>Transformamos o mercado de revenda em uma experiência simples, confiável e acessível.</p>
        </div>
    </header>

    <main class="main-container">
        <section class="about-section">
            <div class="about-text">
                <h2>Missão e Visão</h2>
                <p><strong>Missão:</strong> Proporcionar uma plataforma segura, intuitiva e eficiente para conectar compradores e vendedores de produtos de revenda. Acreditamos em dar uma segunda vida aos produtos, promovendo a sustentabilidade e oferecendo uma oportunidade única para cada cliente encontrar aquilo que precisa, a um preço justo.</p>
                <p><strong>Visão:</strong> Ser referência global no mercado de revenda, criando um ecossistema que prioriza a transparência, a confiança e a sustentabilidade. Nosso objetivo é liderar um movimento que redefine o consumo responsável e sustentável.</p>
                <h3>Valores que nos guiam:</h3>
                <ul>
                    <li><strong>Sustentabilidade:</strong> Reduzimos o impacto ambiental ao promover a reutilização de produtos.</li>
                    <li><strong>Confiança:</strong> Construímos uma comunidade baseada na honestidade entre compradores e vendedores.</li>
                    <li><strong>Acessibilidade:</strong> Facilitamos o acesso a produtos de qualidade, a preços acessíveis.</li>
                </ul>
            </div>
            <div class="about-image">
                <img src="../comum/images/outras/teamwork.jpg" alt="Equipe de trabalho">
            </div>
        </section>

        <section class="features">
            <h2>O Que Nos Torna Diferentes</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <h3>Foco na Sustentabilidade</h3>
                    <p>Promovemos a economia circular, dando aos produtos uma segunda chance de uso.</p>
                </div>
                <div class="feature-item">
                    <h3>Comunidade Confiável</h3>
                    <p>Implementamos sistemas de segurança para proteger as transações e construir relações de confiança.</p>
                </div>
                <div class="feature-item">
                    <h3>Facilidade de Uso</h3>
                    <p>Desenvolvemos ferramentas simples e intuitivas para conectar vendedores e compradores com eficiência.</p>
                </div>
            </div>
        </section>
    </main>

</body>
</html>
