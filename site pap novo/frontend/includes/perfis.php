<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Obtém o username da URL
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

if (empty($username)) {
    echo "<p>Utilizador não encontrado.</p>";
    exit;
}

// Busca os dados do utilizador
$sqlUser = "SELECT * FROM utilizador WHERE username = '$username'";
$resultUser = $lig->query($sqlUser);

if ($resultUser->num_rows == 0) {
    echo "<p>Utilizador não encontrado.</p>";
    exit;
}

$utilizador = $resultUser->fetch_assoc();

// Busca os produtos que o utilizador está a vender
$sqlProdutos = "SELECT * FROM Produtos WHERE email = \"".$utilizador['email']."\"";
$resultProdutos = $lig->query($sqlProdutos);

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de <?php echo htmlspecialchars($utilizador['username']); ?></title>
    <link rel="stylesheet" href="assets/css/perfil.css">
    <link rel="stylesheet" href="assets/css/mosaicos.css">
    <link rel="stylesheet" href="assets/css/perfis.css">

    
</head>
<body>
<?php
	if(isset($_SESSION['email']))
		require("./assets/html/menulogado.php");
	else
		require("./assets/html/menusemlogin.php");
    ?>
<div class="perfil-container">
    <div class="perfil-header">
        <img src="<?php echo !empty($utilizador['foto_ut']) ? htmlspecialchars($utilizador['foto_ut']) : 'assets/images/default-user.png'; ?>" alt="Foto de perfil">
        <div class="perfil-info">
            <h2><?php echo htmlspecialchars($utilizador['nome_completo']); ?></h2>
            <p>@<?php echo htmlspecialchars($utilizador['username']); ?></p>
        </div>
    </div>

    <h3 style= "margin-top : 3%; margin-left: 7%;">Armário</h3>
<div class="container mt-5">
    <div class="row">
        <?php while ($produto = $resultProdutos->fetch_assoc()): ?>
            <div class="col-md-3 mb-4 reveal"> <div class="card">
                    <div class="card-image-container position-relative">
                        <img
                            src="<?php echo htmlspecialchars($produto['foto_prod'] ?? 'default.jpg'); ?>"
                            class="card-img-top product-thumb"
                            alt="<?php echo htmlspecialchars($produto['titulo']); ?>"
                        >
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($produto['titulo']); ?></h5>
                        <p class="card-text">
                            <strong>Preço:</strong> €<?php echo htmlspecialchars($produto['preco']); ?><br>
                            <strong>Descrição:</strong> <?php echo htmlspecialchars($produto['descricao']); ?>
                        </p>
                        <button class="btn btn-primary" onclick="window.location.href='index.php?cmd=produto_detalhes&id_prod=<?php echo $produto['id_prod']; ?>'">Ver Detalhes</button>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</div>

</body>

<script>
    function reveal() {
        const reveals = document.querySelectorAll('.reveal');

        reveals.forEach(reveal => {
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        reveal.classList.add('active');
                        observer.unobserve(reveal); // Para de observar após a revelação
                    }
                });
            });

            observer.observe(reveal);
        });
    }

    reveal(); // Chama a função para iniciar a observação
</script>
</html>