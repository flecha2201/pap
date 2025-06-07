
<style>
/* Definições globais */
body {
    margin: 0;
    padding: 0;
    background: var(--selago); /* Fundo mais leve */
    color: #444; /* Texto escuro para melhor contraste */
}

/* Cabeçalho */
header {
    background: var(--royal-blue);
    color: white;
    text-align: center;
    padding: 20px;
    font-size: 28px;
    font-weight: bold;
    letter-spacing: 1.2px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
}

/* Layout - Mostra um retângulo de cada vez */
.localizacoes-container {
    max-width: 800px;
    margin: 40px auto;
}

/* Estilo das localizações */
.localizacao {
    background: white; /* Fundo claro */
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.4s ease-in-out, box-shadow 0.4s ease-in-out;
    border-left: 6px solid var(--portage);
    margin-bottom: 30px; /* Espaço entre os cards */
}

/* Títulos */
.localizacao h2 {
    color: var(--royal-blue);
    margin-bottom: 10px;
    font-size: 22px;
    font-weight: bold;
}

/* Links */
a {
    color: var(--portage);
    font-weight: bold;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
    color: var(--perfume);
}

/* Estilo do mapa */
.map-container {
    text-align: center;
    margin-top: 15px;
}

.map-container iframe {
    width: 100%;
    height: 300px;
    border-radius: 8px;
    border: 2px solid var(--perano);
}

/* Animação */
.localizacao:hover {
    transform: translateY(-6px);
    box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.2);
}


</style>
<?php


// Consulta para obter todas as localizações
$sql = "SELECT * FROM localizacoes";
$result = $lig->query($sql);

?>


    <link rel="stylesheet" href="assets/css/loc.css">
	  <script src="https://unpkg.com/scrollreveal"></script> <!-- Biblioteca ScrollReveal -->

<body>


<?php
	if(isset($_SESSION['email']))
		require("./assets/html/menulogado.php");
	else
		require("./assets/html/menusemlogin.php");
?>
<main>
    <div class="localizacoes-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<section class="localizacao">';
                echo '<h2>' . htmlspecialchars($row["nome_loc"]) . '</h2>';
                echo '<p><strong>Morada:</strong> ' . htmlspecialchars($row["morada"]) . ', ' . htmlspecialchars($row["cidade"]) . '</p>';
                echo '<p><strong>Telefone:</strong> ' . htmlspecialchars($row["telefone"]) . '</p>';
                echo '<p><strong>Email:</strong> <a href="mailto:' . htmlspecialchars($row["email"]) . '">' . htmlspecialchars($row["email"]) . '</a></p>';
                echo '<p><strong>Horário:</strong> ' . htmlspecialchars($row["horario"]) . '</p>';
                echo '<div class="map-container">';
                echo '<iframe src="' . htmlspecialchars($row["link_mapa"]) . '" allowfullscreen="" loading="lazy"></iframe>';
                echo '</div>';
                echo '</section>';
            }
        } else {
            echo "<p>Nenhuma localização encontrada.</p>";
        }
        $lig->close();
        ?>
    </div>
</main>


</body>


<script>
    // Animação com ScrollReveal
    ScrollReveal().reveal('.localizacao', {
        origin: 'bottom',
        distance: '50px',
        duration: 500,
        delay: 200,
        easing: 'ease-in-out',
        reset: false
    });
</script>