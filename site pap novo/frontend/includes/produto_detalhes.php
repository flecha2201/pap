<?php
include './includes/ligamysql.php';

if (isset($_GET['id_prod'])) {
    $id_prod = intval($_GET['id_prod']);

    // Obter detalhes do produto
    $sql_produto = "
        SELECT P.*, U.username, U.foto_ut 
        FROM Produtos P
        JOIN utilizador U ON P.email = U.email
        WHERE P.id_prod = $id_prod
    ";
    $result_produto = $lig->query($sql_produto);

    if ($result_produto && $result_produto->num_rows > 0) {
        $produto = $result_produto->fetch_assoc();
    } else {
        echo "Produto não encontrado.";
        exit;
    }

    // Obter imagens do produto
    $sql_imagens = "SELECT caminho_img FROM prod_imgs WHERE id_produto = $id_prod";
    $result_imagens = $lig->query($sql_imagens);

    $imagens = [];
    if ($result_imagens && $result_imagens->num_rows > 0) {
        while ($row = $result_imagens->fetch_assoc()) {
            $imagens[] = $row['caminho_img'];
        }
    }

    // Adicionar a imagem principal ao início do array de imagens
    array_unshift($imagens, $produto['foto_prod']);
} else {
    echo "Produto não especificado.";
    exit;
}
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhe do Produto - <?php echo htmlspecialchars($produto['titulo']); ?></title>
    <link rel="stylesheet" href="./assets/css/detalhe_produto.css">
</head>
<body>
    <?php
    if (isset($_SESSION['email'])) {
        include("./assets/html/menulogado.php");
    } else {
        include("./assets/html/menusemlogin.php");
    }
    ?>

    <div class="produto-detail">
        <!-- Slideshow -->
       <div class="slideshow-container">
    <?php foreach ($imagens as $index => $imagem): ?>
        <div class="slide <?php echo $index === 0 ? 'active' : ''; ?>">
            <img src="<?php echo htmlspecialchars($imagem); ?>" alt="Imagem do Produto">
        </div>
    <?php endforeach; ?>

    <!-- Botões de navegação -->
    <button class="prev" onclick="plusSlides(-1)"><img src="./assets/images/arrow.png" alt=""></button>
    <button class="next" onclick="plusSlides(1)"><img src="./assets/images/arrow.png" alt=""></button>


<!-- Miniaturas (certifique-se de que está fora e abaixo do slideshow-container) -->
<div class="thumbnail-container">
    <?php foreach ($imagens as $index => $imagem): ?>
        <div class="thumbnail <?php echo $index === 0 ? 'active' : ''; ?>" onclick="currentSlide(<?php echo $index + 1; ?>)">
            <img src="<?php echo htmlspecialchars($imagem); ?>" alt="Miniatura">
        </div>
    <?php endforeach; ?>
</div>
</div>
        <!-- Informações do produto -->
        <div class="produto-info">
            <h1><?php echo htmlspecialchars($produto['titulo']); ?></h1>
            <p><?php echo nl2br(htmlspecialchars($produto['descricao'])); ?></p>
            <p><strong>Preço:</strong> <?php echo htmlspecialchars($produto['preco']); ?>€</p>
            <p><strong>Tamanho:</strong> <?php echo htmlspecialchars($produto['size']); ?></p>
            <p>
                <strong>Vendido por:</strong> 
                <img src="<?php echo htmlspecialchars($produto['foto_ut']); ?>" alt="Foto do vendedor" class="seller-avatar">
                <?php echo htmlspecialchars($produto['username']); ?>
            </p>
            <button class="btn-comprar" onclick="window.location.href='index.php?cmd=checkout&id_prod=<?php echo $produto['id_prod']; ?>'">Comprar agora</button>
        </div>
    </div>



    <script>
let slideIndex = 0;

function showSlides(index) {
    const slides = document.querySelectorAll('.slide');
    const thumbnails = document.querySelectorAll('.thumbnail');

    // Proteger contra índices fora do intervalo
    if (index >= slides.length) slideIndex = 0;
    if (index < 0) slideIndex = slides.length - 1;

    // Esconder todos os slides e remover a classe ativa das miniaturas
    slides.forEach((slide) => slide.classList.remove('active'));
    thumbnails.forEach((thumb) => thumb.classList.remove('active'));

    // Mostrar o slide atual e destacar a miniatura correspondente
    slides[slideIndex].classList.add('active');
    thumbnails[slideIndex].classList.add('active');
}

function plusSlides(n) {
    slideIndex += n;
    showSlides(slideIndex);
}

function currentSlide(n) {
    slideIndex = n - 1;
    showSlides(slideIndex);
}

// Iniciar com o primeiro slide ativo
document.addEventListener('DOMContentLoaded', () => {
    showSlides(slideIndex);
});

    </script>
</body>
</html>