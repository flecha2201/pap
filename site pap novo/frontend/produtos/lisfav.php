<?php
session_start();
include './includes/ligamysql.php';

// Consulta para favoritos
$sql = "
    SELECT 
        p.id_prod, 
        p.titulo, 
        p.size, 
        p.preco, 
        p.foto_prod, 
        p.descricao, 
        u.username, 
        u.foto_ut
    FROM favoritos f
    JOIN Produtos p ON f.id_prod = p.id_prod
    JOIN utilizador u ON p.email = u.email
    WHERE f.email = '" . $_SESSION['email'] . "';
";

$resultado = $lig->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoritos - ReVibe</title>
    <link rel="stylesheet" href="./assets/css/slideshow.css">
    <link rel="stylesheet" href="./assets/css/home.css">
    <link rel="stylesheet" href="./assets/css/mosaicos.css"> <!-- Estilo para layout -->

</head>
<body>
    <?php include './includes/navbar.php'; ?>

    <div class="container mt-5">
        <h1 class="mb-4">Favoritos<button onclick="gerarPDF();">Imprimir Favoritos</button></h1>
        <div class="row">
            <?php while ($produto = $resultado->fetch_assoc()): ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img 
    src="<?php echo htmlspecialchars($produto['foto_prod'] ?? '../comum/images/prod/default.jpg'); ?>" 
    class="card-img-top product-thumb" 
    alt="<?php echo htmlspecialchars($produto['titulo']); ?>" 
    data-id="<?php echo $produto['id_prod']; ?>" 
    data-title="<?php echo htmlspecialchars($produto['titulo']); ?>" 
    data-description="<?php echo htmlspecialchars($produto['descricao']); ?>" 
    data-price="<?php echo htmlspecialchars($produto['preco']); ?>" 
    data-size="<?php echo htmlspecialchars($produto['size']); ?>"
    data-username="<?php echo htmlspecialchars($produto['username']); ?>" 
    data-avatar="<?php echo htmlspecialchars($produto['foto_ut'] ?? '../comum/images/prod/default-user.jpg'); ?>">

                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($produto['titulo']); ?></h5>
                            <p class="card-text">
                                <strong>Preço:</strong> €<?php echo htmlspecialchars($produto['preco']); ?><br>
								<strong>Vendedor:</strong> <?php echo htmlspecialchars($produto['username']); ?><br>
                                <strong>Tamanho:</strong> <?php echo htmlspecialchars($produto['size']); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Modal -->
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
          <p><strong>Descrição:</strong> <span id="modalProductDescription"></span></p>
          <p><strong>Preço:</strong> <span id="modalProductPrice"></span></p>
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

<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profileModalLabel">Painel de Utilizador</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="user-info text-center">
         <img src="<?php echo $_SESSION['foto_ut']; ?>" class="rounded-circle mb-3" style="width: 80px; height: 80px; object-fit: cover;">
          <h4><?php echo $_SESSION['username']; ?></h4>
          <hr>
          <a href="index.php?cmd=perfil" class="btn btn-outline-primary w-100 mb-2">Editar Perfil</a>
          <a href="index.php?cmd=logout" class="btn btn-outline-danger w-100">Logout</a>
        </div>
      </div>
    </div>
  </div>
</div>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.product-thumb').forEach(img => {
    img.addEventListener('click', () => {
        const modalImage = document.getElementById('modalProductImage');
        const modalTitle = document.getElementById('modalProductTitle');
        const modalDescription = document.getElementById('modalProductDescription');
        const modalPrice = document.getElementById('modalProductPrice');
        const modalSize = document.getElementById('modalProductSize');
        const modalSellerName = document.getElementById('modalSellerName');
        const modalSellerAvatar = document.getElementById('modalSellerAvatar');

        // Preencher os dados no modal
        modalImage.src = img.getAttribute('src');
        modalTitle.textContent = img.getAttribute('data-title');
        modalDescription.textContent = img.getAttribute('data-description');
        modalPrice.textContent = "€" + img.getAttribute('data-price');
        modalSize.textContent = img.getAttribute('data-size');
        modalSellerName.textContent = img.getAttribute('data-username');
        modalSellerAvatar.src = img.getAttribute('data-avatar');

        // Mostrar o modal
        const productModal = new bootstrap.Modal(document.getElementById('productModal'));
        productModal.show();
    });
});

    function gerarPDF() {
        window.open('pdf/pdfav.php?email=<?php echo $_SESSION['email']; ?>&nome=<?php echo $_SESSION['username']; ?>', '_blank');
    }

    </script>
</body>
</html>
