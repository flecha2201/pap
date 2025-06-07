<?php
session_start();
include './includes/ligamysql.php';

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
    FROM Produtos p
    JOIN utilizador u ON p.email = u.email
    WHERE p.email = '" . $_SESSION['email'] . "'
      AND p.encomendado = 0;
";


$resultado = $lig->query($sql);
?>

 <style>
        /* Paleta de cores */
        :root {
            --portage: #9572f1;
            --hawkes-blue: #d3d3fb;
            --perfume: #b690f7;
            --royal-blue: #524ae3;
            --perano: #b0aff5;
            --selago: #ece4fc;
            --spindle: #bcbcec;
            --danger-red: rgb(220, 53, 69);
        }

        /* Modal de confirmação */
        .modal-content {
            border-radius: 15px;
            background-color: var(--selago);
            border: 2px solid var(--royal-blue);

        }

        .modal-header {
            background-color: var(--royal-blue);
            color: #fff;
            border-radius: 15px 15px 0 0;
        }

        .modal-footer {
            border-top: none;
        }

        .btn-danger {
            background-color: var(--danger-red);
            border: none;
        }

        .btn-danger:hover {
            background-color: darkred;
        }

        /* Animação de remoção */
        .fade-out {
            transition: opacity 0.5s ease-out;
            opacity: 0;
        }
    </style>
</head>
    <link rel="stylesheet" href="./assets/css/slideshow.css">
    <link rel="stylesheet" href="./assets/css/home.css">
    <link rel="stylesheet" href="./assets/css/mosaicos.css"> <!-- Estilo para layout -->
    <style>
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
        }/* Animação de remoção */
.fade-out {
    transition: opacity 0.5s ease-out;
    opacity: 0;
}

    </style>
</head>
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Confirmar Remoção</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                Tem certeza de que deseja remover este produto?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Remover</button>
            </div>
        </div>
    </div>
</div>


<body>
<?php
	if(isset($_SESSION['email']))
		require("./assets/html/menulogado.php");
	else
		require("./assets/html/menusemlogin.php");
?>
    <div class="container mt-5">
		<?php if($resultado->num_rows <= 0) { ?>
		<h1 class="mb-4">Produtos que tem à Venda</h1>
		<div class="table-wishlist">
                    <center><h1 style="margin-top: 3%;">Não tem nenhum produto à venda!</h1></center>
                </div>
		<?php } else { ?>
        <h1 class="mb-4">Produtos que tem à Venda</h1>
		
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
                            <h5 class="card-title"><?php echo htmlspecialchars(mb_strimwidth($produto['titulo'], 0, 20, '...')); ?></h5>
                            <p class="card-text">
                                <strong>Preço:</strong> €<?php echo htmlspecialchars($produto['preco']); ?><br>
                                <strong>Vendedor:</strong>  <?php echo htmlspecialchars(mb_strimwidth($produto['username'], 0, 20, '...')); ?><br>
                                <strong>Tamanho:</strong> <?php echo htmlspecialchars($produto['size']); ?>
                            </p>
                            <!-- Botão "Fazer Alterações" -->
<button 
    type="button" 
    onclick="window.location.href='index.php?cmd=edprod&id_prod=<?php echo urlencode($produto['id_prod']); ?>';"  
    class="btn btn-primary">
    Fazer Alterações
</button>

<!-- Botão "Remover" com modal -->
<button 
    type="button" 
    class="btn btn-danger"
    data-bs-toggle="modal"
    data-bs-target="#confirmDeleteModal"
    onclick="setProductToDelete(<?php echo $produto['id_prod']; ?>)">
    Remover
</button>




                        </div>
                    </div>
                </div>
			<?php endwhile; ?>
        </div>
    </div>
	<?php } ?>

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
        <div class="alert alert-danger alert-dismissible fade" role="alert" id="removeAlert">
            <span>Produto removido da sua lista!</span>
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



        function removeProduto(id) {
    // Mostrar um popup de confirmação
    const confirmacao = confirm("Tem a certeza de que quer remover este produto?");
    if (confirmacao) {
        // Redirecionar para o script de remoção com o ID correto
        window.location.href = `index.php?cmd=delprod&id_prod=${id}`;
    }
}

   
let produtoAremover = null;

function setProductToDelete(id) {
    produtoAremover = id;
}

function confirmDelete() {
    if (produtoAremover !== null) {
        fetch(`index.php?cmd=delprod&id_prod=${produtoAremover}`, {
            method: 'GET'
        })
        .then(response => response.text())
        .then(data => {
            // Esconder o modal
            let modal = bootstrap.Modal.getInstance(document.getElementById('confirmDeleteModal'));
            modal.hide();

            // Remover o produto visualmente
            let produtoCard = document.querySelector(`[data-id="${produtoAremover}"]`).closest('.col-md-3');
            if (produtoCard) {
                produtoCard.classList.add('fade-out');
                setTimeout(() => produtoCard.remove(), 500);
            }

            // Mostrar alerta de sucesso
            let alertBox = document.getElementById('removeAlert');
            alertBox.classList.add('show');
            setTimeout(() => alertBox.classList.remove('show'), 3000);
        })
        .catch(error => console.error('Erro ao remover produto:', error));
    }
}
</script>

</body>
</html>
