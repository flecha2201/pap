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


<?php
$email_utilizador = $_SESSION['email']; // O email do utilizador logado

$sql = "
    SELECT 
        P.*, 
        U.username, 
        U.foto_ut,
        F.id_prod AS favorito
    FROM Produtos P
    JOIN utilizador U ON P.email = U.email
    LEFT JOIN favoritos F ON P.id_prod = F.id_prod AND F.email = '$email_utilizador'
    ORDER BY P.data_add DESC
    LIMIT 12;
";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoritos - ReVibe</title>
    <link rel="stylesheet" href="./assets/css/mosaicos.css"> <!-- Estilo para layout -->
	<link rel="stylesheet" href="./assets/css/favorite-button.css"> 
    <style>
	:root {
    --portage: #9572f1;
    --hawkes-blue: #d3d3fb;
    --perfume: #b690f7;
    --royal-blue: #524ae3;
    --portage-light: #938bf0;
    --perfume-light: #c1b0fb;
    --link-water: #f1f1fc;
    --perano: #b0aff5;
    --selago: #ece4fc;
    --spindle: #bcbcec;
}

        #wishAlert {
    display: none;
    padding: 15px 25px;
    background-color: var(--perano); /* Tom claro para representar sucesso */
    color: #000; /* Texto preto para contraste */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: fixed;
    top: 20px;
    right: 2%;
    transform: translateX(-50%) translateY(-100%);
    z-index: 9999;
    transition: transform 0.5s ease-out, opacity 0.5s ease-out;
    opacity: 0;
}

#wishAlert.show {
    transform: translateX(-50%) translateY(0);
    opacity: 1;
}

#wishAlertE {
    display: none;
    padding: 15px 25px;
    background-color: var(--royal-blue); /* Tom mais escuro e chamativo */
    color: #fff; /* Texto branco para contraste */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: fixed;
    top: 20px;
    right: -2%;
    transform: translateX(-50%) translateY(-100%);
    z-index: 9999;
    transition: transform 0.5s ease-out, opacity 0.5s ease-out;
    opacity: 0;
}

#wishAlertE.show {
    transform: translateX(-50%) translateY(0);
    opacity: 1;
}
        #removeAlert {
            display: none;
            padding: 15px 25px;
            background-color: rgb(220, 53, 69);
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: fixed;
            top: 20px;
            right: 2%;
            transform: translateX(-50%) translateY(-100%);
            z-index: 9999;
            transition: transform 0.5s ease-out, opacity 0.5s ease-out;
            opacity: 0;
        }

        #removeAlert.show {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }
    </style>
</head>
<body>
<?php
	if(isset($_SESSION['email']))
		require("./assets/html/menulogado.php");
	else
		require("./assets/html/menusemlogin.php");
?>
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
    <div class="alert alert-success alert-dismissible fade" role="alert" id="wishAlert" style="display: none;">
        <span>Produto adicionado aos favoritos</span>
    </div>
    <div class="alert alert-success alert-dismissible fade" role="alert" id="wishAlertE" style="display: none;">
        <span>Produto já adicionado aos favoritos</span>
    </div>
    <div class="alert alert-danger alert-dismissible fade" role="alert" id="removeAlert" style="display: none;">
        <span>Produto removido dos favoritos!</span>
    </div>
</div>
<div class="container mt-5">
    <h1 class="mb-4">Meus Favoritos</h1>

    <?php if ($resultado->num_rows == 0): ?>
        <center><h3>Não tem nenhum item nos seus favoritos!</h3></center>
    <?php else: ?>
        <div class="row">
            <?php while ($produto = $resultado->fetch_assoc()): ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="user-info d-flex align-items-center justify-content-center mb-3">
                            <img src="<?php echo htmlspecialchars($produto['foto_ut']); ?>" alt="Foto do vendedor" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                            <span class="user-name ms-2"><?php echo htmlspecialchars($produto['username']); ?></span>
                        </div>
                        <div class="card-image-container position-relative">
                            <img 
                                src="<?php echo htmlspecialchars($produto['foto_prod'] ?? 'default.jpg'); ?>" 
                                class="card-img-top product-thumb"
                                alt="<?php echo htmlspecialchars($produto['titulo']); ?>" 
                                data-id="<?php echo $produto['id_prod']; ?>"
                                data-title="<?php echo htmlspecialchars($produto['titulo']); ?>"
                                data-description="<?php echo htmlspecialchars($produto['descricao']); ?>"
                                data-price="<?php echo htmlspecialchars($produto['preco']); ?>"
                                data-size="<?php echo htmlspecialchars($produto['size']); ?>"
                                data-username="<?php echo htmlspecialchars($produto['username']); ?>"
                                data-avatar="<?php echo htmlspecialchars($produto['foto_ut'] ?? 'default-user.jpg'); ?>"
                            >

                            <!-- Botão de Favorito -->
                            <input type="checkbox" id="favorite-<?php echo $produto['id_prod']; ?>" class="favorite-checkbox" checked>
                            <label for="favorite-<?php echo $produto['id_prod']; ?>" class="favorite-container"
                                onclick="toggleWishlistFavoritos(<?php echo $produto['id_prod']; ?>)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="red">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                            </label>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($produto['titulo']); ?></h5>
                            <p class="card-text">
                                <strong>Preço:</strong> €<?php echo htmlspecialchars($produto['preco']); ?><br>
                                <strong>Vendedor:</strong> <?php echo htmlspecialchars($produto['username']); ?><br>
                                <strong>Tamanho:</strong> <?php echo htmlspecialchars($produto['size']); ?>
                            </p>
							            <button onclick="window.location.href='index.php?cmd=produto_detalhes&id_prod=<?php echo $produto['id_prod']; ?>'" class="btn btn-primary">Ver Detalhes</button>

                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
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
          <a href="index.php?cmd=armario" class="btn btn-outline-primary w-100 mb-2">O meu Armário</a>
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

function toggleWishlistFavoritos(id_prod) {
    const checkbox = document.getElementById(`favorite-${id_prod}`);
    const heartIcon = checkbox.nextElementSibling.querySelector('svg');

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        const response = this.responseText.trim();

        if (response === "add") {
            document.getElementById('wishAlert').style.display = 'block';
            setTimeout(() => document.getElementById('wishAlert').classList.add('show'), 10);
            setTimeout(() => {
                document.getElementById('wishAlert').classList.remove('show');
                setTimeout(() => document.getElementById('wishAlert').style.display = 'none', 500);
            }, 3000);

            checkbox.checked = true;
            heartIcon.setAttribute("fill", "red");

        } else if (response === "remove") {
            document.getElementById('removeAlert').style.display = 'block';
            setTimeout(() => document.getElementById('removeAlert').classList.add('show'), 10);
            setTimeout(() => {
                document.getElementById('removeAlert').classList.remove('show');
                setTimeout(() => document.getElementById('removeAlert').style.display = 'none', 500);
            }, 3000);

            checkbox.checked = false;
            heartIcon.setAttribute("fill", "none");

            // **Remover o item da página**
            const productCard = checkbox.closest('.col-md-3');
            if (productCard) {
                productCard.style.transition = "opacity 0.5s ease-out";
                productCard.style.opacity = "0";
                setTimeout(() => productCard.remove(), 500);
            }
        } else {
            alert('Erro ao processar: ' + response);
        }
    };

    xhttp.open("GET", "html/toggle-wishlist.php?id_prod=" + id_prod, true);
    xhttp.send();
}



    </script>
</body>
</html>

</body>
</html>
