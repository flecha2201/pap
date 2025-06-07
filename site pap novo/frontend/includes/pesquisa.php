<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Obter o termo da pesquisa
if (isset($_GET['pesquisa'])) {
    $termoPesquisa = $_GET['pesquisa'];
} else {
    $termoPesquisa = '';
}

$tp = 12; // Produtos por página
$np = isset($_REQUEST['pag']) ? $_REQUEST['pag'] : 1;
$ini = ($np - 1) * $tp;

// Query base
$emailUtilizador = isset($_SESSION['email']) ? $_SESSION['email'] : '';

$sql = "SELECT p.*,
            c.nome_categoria,
            u.username,
            u.foto_ut,
            IF(f.id_prod IS NOT NULL, 1, 0) AS favorito
        FROM Produtos p
        LEFT JOIN categorias c ON p.id_categoria = c.cod_categorias
        LEFT JOIN utilizador u ON p.email = u.email
        LEFT JOIN favoritos f ON p.id_prod = f.id_prod AND f.email = '$emailUtilizador'
        WHERE (p.titulo LIKE '%$termoPesquisa%'
               OR u.username LIKE '%$termoPesquisa%'
               OR c.nome_categoria LIKE '%$termoPesquisa%')
          AND p.encomendado = 0";


// Obter o número total de resultados
$ress = $lig->query($sql);
$nr = $ress->num_rows;
$qp = ceil($nr / $tp);

// Adicionar limite para paginação
$sql .= " LIMIT $ini, $tp";
$ress = $lig->query($sql);
?>

    <link rel="stylesheet" href="./assets/css/mosaicos.css">
    <link rel="stylesheet" href="./assets/css/favorite-button.css">
<body>

<?php include isset($_SESSION['email']) ? "./assets/html/menulogado.php" : "./assets/html/menusemlogin.php"; ?>

<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
    <div class="alert alert-success alert-dismissible fade" role="alert" id="wishAlert" style="display: none;">
        <span>Produto adicionado aos favoritos</span>
    </div>
    <div class="alert alert-danger alert-dismissible fade" role="alert" id="removeAlert" style="display: none;">
        <span>Produto removido dos favoritos</span>
    </div>
</div>


<div class="container mt-4">
    <?php if($nr > 0): ?>
        <h2>Resultados da pesquisa para "<?php echo htmlspecialchars($termoPesquisa); ?>"</h2>
    <?php endif; ?>
</div>
<?php if ($nr == 0): ?>
    <div class="no-results text-center">
        <strong>😕 Oops!</strong> Não foram encontrados resultados para "<span class="search-term"><?php echo htmlspecialchars($termoPesquisa); ?></span>".
    </div>
<?php endif; ?>

<div class="container mt-5">
    <div class="row">
        <?php while ($produto = $ress->fetch_assoc()): ?>
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
                            alt="<?php echo htmlspecialchars(mb_strimwidth($produto['titulo'], 0, 20, '...')); ?>"
                        >
                        <input type="checkbox" id="favorite-<?php echo $produto['id_prod']; ?>" class="favorite-checkbox" <?php echo $produto['favorito'] ? 'checked' : ''; ?>>
                        <label for="favorite-<?php echo $produto['id_prod']; ?>" class="favorite-container"
                           onclick="<?php if (isset($_SESSION['email'])) { ?>
            toggleWishlistVerMais(<?php echo $produto['id_prod']; ?>);
        <?php } else { ?>
            window.location.href='index.php?cmd=form-login';
        <?php } ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="<?php echo $produto['favorito'] ? 'red' : 'none'; ?>" stroke="black" stroke-width="2">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </label>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars(mb_strimwidth($produto['titulo'], 0, 20, '...')); ?></h5>
                        <p class="card-text">
                            <strong>Preço:</strong> €<?php echo htmlspecialchars($produto['preco']); ?><br>
                            <strong>Categoria:</strong> <?php echo htmlspecialchars($produto['nome_categoria']); ?>
                        </p>
                        <button class="btn btn-primary" onclick="window.location.href='index.php?cmd=produto_detalhes&id_prod=<?php echo $produto['id_prod']; ?>'">Ver Detalhes</button>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<nav>
    <ul class="pagination justify-content-center mt-4">
        <?php for ($i = 1; $i <= $qp; $i++): ?>
            <li class="page-item <?php echo ($i == $np) ? 'active' : ''; ?>">
                <a class="page-link" href="index.php?cmd=pesquisa&pesquisa=<?php echo urlencode($termoPesquisa); ?>&pag=<?php echo $i; ?>">
                    <?php echo $i; ?>
                </a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>

<script>
function toggleWishlistVerMais(id_prod) {
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
        } else {
            alert('Erro ao processar: ' + response);
        }
    };

    xhttp.open("GET", "html/toggle-wishlist.php?id_prod=" + id_prod, true);
    xhttp.send();
}
</script>