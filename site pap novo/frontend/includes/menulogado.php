<?php
$sql = "
SELECT 
    P.*, 
    U.username, 
    U.foto_ut
FROM Produtos P
JOIN utilizador U ON P.email = U.email
WHERE P.encomendado = 0
ORDER BY P.data_add DESC
LIMIT 12;
";


?>
<?php
$email_utilizador = $_SESSION['email'];
$sql = "
    SELECT 
        P.*, 
        U.username, 
        U.foto_ut,
        F.id_prod AS favorito
    FROM Produtos P
    JOIN utilizador U ON P.email = U.email
    LEFT JOIN favoritos F ON P.id_prod = F.id_prod AND F.email = '$email_utilizador'
    WHERE P.encomendado = 0
    ORDER BY P.data_add DESC
    LIMIT 12;
";

?>


<?php include './includes/ligamysql.php';?>


<head>
 <link rel="icon" href="./assets/images/logo.png">
    <title>ReVibe</title>
    <link rel="stylesheet" href="./assets/css/slideshow.css"/>
    <link rel="stylesheet" href="./assets/css/home.css"/>
    <link rel="stylesheet" href="./assets/css/favorite-button.css">
    <link rel="stylesheet" href="./assets/css/favnavbar.css">
</head>

<!-- Navbar -->
<?php
	if(isset($_SESSION['email']))
		require("./assets/html/menulogado.php");
	else
		require("./assets/html/menusemlogin.php");
?>
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
  <div class="alert alert-success alert-dismissible fade" role="alert" id="wishAlert" style="display: none;">
    <span>Produto adicionado a sua lista de favoritos!</span>
  </div>
</div>

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
        <div class="alert alert-danger alert-dismissible fade" role="alert" id="removeAlert">
            <span>Produto removido dos seus favoritos!</span>
        </div>
    </div>
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
  <div class="alert alert-success alert-dismissible fade" role="alert" id="wishAlertE" style="display: none;">
    <span>Produto ja adicionado aos favoritos!</span>
  </div>
</div>
<!-- Hero -->
<header class="w-100" style="background-image: url('./assets/images/background.png'); background-size: cover; background-position: center; height: 90vh;">
    <div class="d-flex align-items-start" style="height: 100%; padding-left: 10%;">
        <div class="hero-content">
            <h1 class="display-4 text-dark"><b>Reinventa o teu guarda-roupa por menos</b></h1>
            <a href="index.php?cmd=ver_mais" class="btn btn-primary see-more-btn">Comprar</a>
        </div>
    </div>
</header>

<!-- Slideshow -->
<section class="product"> 
    <h2 class="product-category">Novidades</h2>
    <button class="pre-btn"><img src="./assets/images/arrow.png" alt=""></button>
    <button class="nxt-btn"><img src="./assets/images/arrow.png" alt=""></button>
    <div class="product-container">
        <?php $produtos = $lig->query($sql); ?>
        <?php foreach ($produtos as $index => $produto): ?>
    <?php $favoriteId = "favorite-" . $produto['id_prod']; // Cria um id único ?>
    <div class="product-card">
        <div class="user-info">
    <a href="index.php?cmd=conta&user=<?php echo urlencode($produto['username']); ?>" style="text-decoration: none; color: inherit;">
        <img src="<?php echo htmlspecialchars($produto['foto_ut']); ?>" alt="Foto do utilizador" class="rounded-circle mb-3" style="width: 40px; height: 40px; object-fit: cover;">
        <span class="user-name"><?php echo htmlspecialchars($produto['username']); ?></span>
    </a>
</div>
        <div class="product-image" style="margin-top: 5%;">
    <img src="<?php echo htmlspecialchars($produto['foto_prod']); ?>" class="product-thumb" alt="">
    <?php 
        $isFavorito = isset($produto['favorito']); // Verifica se o produto está nos favoritos
        $favoriteId = "favorite-" . $produto['id_prod'];
    ?>
    <input type="checkbox" id="<?php echo $favoriteId; ?>" class="favorite-checkbox" name="favorite-checkbox" <?php echo $isFavorito ? 'checked' : ''; ?>>
    <label for="<?php echo $favoriteId; ?>" class="favorite-container" 
        onclick="<?php if (isset($_SESSION['email'])) { ?>
            toggleWishlist(<?php echo $produto['id_prod']; ?>);
        <?php } else { ?>
            window.location.href='index.php?cmd=form-login';
        <?php } ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="<?php echo $isFavorito ? 'red' : 'none'; ?>" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
        </svg>
    </label>
</div>

        <div class="product-info">
            <h2 class="product-brand">
                <?php echo htmlspecialchars(mb_strimwidth($produto['titulo'], 0, 20, '...')); ?>
            </h2>
            <data-description="<?php echo htmlspecialchars($produto['descricao']); ?>">
            <p class="product-short-description"><?php echo htmlspecialchars($produto['size']); ?></p>
            <span class="price"><p>Preço: <?php echo htmlspecialchars($produto['preco']); ?>€</p></span>
            <button onclick="window.location.href='index.php?cmd=produto_detalhes&id_prod=<?php echo $produto['id_prod']; ?>'">Ver detalhes</button>
        </div>
    </div>
<?php endforeach; ?>

        <div class="see-more-container">
            <a href="index.php?cmd=ver_mais" class="btn btn-primary see-more-btn">Ver Mais</a>
        </div>
    </div>  
</section>

<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="productModalLabel">Detalhes do Produto</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body d-flex">
			<!-- Imagem do Produto -->
			<div class="product-image-modal me-4">
			  <img src="" alt="Produto" class="img-fluid rounded" id="modalProductImage">
			</div>

        <!-- Informações do Produto -->
        <div class="product-details">
          <h4 id="modalProductTitle"></h4>
		<!--  <p><strong>Descrição:</strong> <?php echo htmlspecialchars($produto['descricao']); ?></p> -->

          <p> <span id="modalProductDescription"></span></p>
          <p><strong></strong> <span id="modalProductPrice"></span></p>
          <p><strong>Tamanho:</strong> <span id="modalProductSize"></span></p>
          <p><strong>Vendido por:</strong> <span id="modalProductUsername"></span></p>
          <div class="seller-avatar d-flex align-items-center">
            <img src="" alt="Vendedor" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;" id="modalSellerAvatar">
            <span id="modalSellerName"></span>
          </div>
        </div>
		    
      </div>

      </div>
  </div>
</div>




<!-- Footer -->



 <script>
const productContainers = [...document.querySelectorAll('.product-container')];
const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
const preBtn = [...document.querySelectorAll('.pre-btn')];

productContainers.forEach((item, i) => {
    let containerDimensions = item.getBoundingClientRect();
    let containerWidth = containerDimensions.width;

    nxtBtn[i].addEventListener('click', () => {
        item.scrollLeft += containerWidth;
    })

    preBtn[i].addEventListener('click', () => {
        item.scrollLeft -= containerWidth;
    })
})



 </script>
 
 


<script>
document.querySelectorAll('.product-thumb').forEach((img, index) => {
    img.addEventListener('click', (event) => {
        // Previne que o clique no filho ative outros eventos
        event.stopPropagation();

        // Obter os dados do produto
        const card = img.closest('.product-card');
        const imageSrc = img.getAttribute('src');
        const title = card.querySelector('.product-brand').textContent;
	    const description = card.getAttribute('data-description'); // Obtem a descrição real do produto
        const price = card.querySelector('.price p').textContent;
        const size = card.querySelector('.product-short-description').textContent;
        const username = card.querySelector('.user-name').textContent;
        const userAvatar = card.querySelector('.user-info img').getAttribute('src');

        // Preencher os dados no modal
        document.getElementById('modalProductImage').setAttribute('src', imageSrc);
        document.getElementById('modalProductTitle').textContent = title;
        document.getElementById('modalProductDescription').textContent = description;
        document.getElementById('modalProductPrice').textContent = price;
        document.getElementById('modalProductSize').textContent = size;
        document.getElementById('modalProductUsername').textContent = username;
        document.getElementById('modalSellerAvatar').setAttribute('src', userAvatar);
        document.getElementById('modalSellerName').textContent = username;

        // Abrir o modal
        const productModal = new bootstrap.Modal(document.getElementById('productModal'));
        productModal.show();
    });
});

</script>
