<style>
    body {
    display: flex; /* Ativa Flexbox no body */
    flex-direction: column; /* Define a direção do Flexbox para coluna (vertical) */
    min-height: 100vh; /* Garante que o body ocupa pelo menos 100% da altura do viewport */
}

.container.mt-5 { /* Se o seu conteúdo principal está dentro de um container com a classe 'container mt-5' */
    flex: 1; /* Faz com que o container de conteúdo principal cresça e ocupe o espaço vertical disponível */
}

footer { /* Se o seu rodapé estiver dentro de uma tag <footer>, ajuste conforme necessário */
    margin-top: auto; /* Empurra o rodapé para a parte inferior, utilizando o espaço 'auto' de margem superior */
}

</style>
<?php
session_start();
include './includes/ligamysql.php';

// Filtros e paginação
$tp = 12;
$np = isset($_REQUEST['pag']) ? $_REQUEST['pag'] : 1;
$ini = ($np - 1) * $tp;

// Filtros de Categoria - CÓDIGO CORRIGIDO PARA CATEGORIAS PRINCIPAIS E SUBCATEGORIAS RECURSIVAS (INCLUINDO SUBCATEGORIAS DIRETAS)
$categoria_principal_cod = null;
$categoria_cod = null;
$filtroCategoria = '';
$cod_param = null;

if (isset($_GET['categoria_principal'])) {
    $categoria_principal_cod = $_GET['categoria_principal'];
    $cod_param = $categoria_principal_cod;
    $filtroCategoria = $categoria_principal_cod;
} elseif (isset($_GET['cod'])) {
    $categoria_cod = $_GET['cod'];
    $cod_param = $categoria_cod;
    $filtroCategoria = $categoria_cod;
}

$categoria_ids = [];

// Função RECURSIVA para obter todas as subcategorias - MANTIDO IGUAL
function obterSubcategoriasRecursivas($lig, $categoria_pai_id, &$categoria_ids_recursivas) {
    $categoria_ids_recursivas[] = $categoria_pai_id;

    $sql_subcategorias = "SELECT cod_categorias FROM categorias WHERE pai = " . $categoria_pai_id;
    $res_subcategorias = $lig->query($sql_subcategorias);

    if ($res_subcategorias->num_rows > 0) {
        while ($subcategoria = $res_subcategorias->fetch_array()) {
            $subcategoria_id = $subcategoria['cod_categorias'];
            obterSubcategoriasRecursivas($lig, $subcategoria_id, $categoria_ids_recursivas);
        }
    }
}

// Aplicar recursão SE tiver categoria principal OU categoria específica selecionada
if ($categoria_principal_cod !== null) {
    obterSubcategoriasRecursivas($lig, $categoria_principal_cod, $categoria_ids);
} elseif ($categoria_cod !== null) {
    obterSubcategoriasRecursivas($lig, $categoria_cod, $categoria_ids); // Aplicar recursão também para subcategorias diretas!
}

$categoria_ids_string = implode(',', $categoria_ids);


$pesquisa = isset($_REQUEST['pesquisa']) ? '%' . $_REQUEST['pesquisa'] . '%' : '';

// Consulta SQL MODIFICADA para usar IN clause para categorias - MANTIDO IGUAL
$sql = "
    SELECT
        P.id_prod,
        P.titulo,
        P.size,
        P.preco,
        P.foto_prod,
        P.data_add,
        P.descricao,
        U.username,
        U.foto_ut,
        C.nome_categoria,
        (SELECT COUNT(*) FROM favoritos F WHERE F.id_prod = P.id_prod AND F.email = '{$_SESSION['email']}') AS favorito
    FROM Produtos P
    JOIN utilizador U ON P.email = U.email
    JOIN categorias C ON P.id_categoria = C.cod_categorias
    WHERE 1=1
      AND P.encomendado = 0
";


if (!empty($categoria_ids_string)) {
    $sql .= " AND P.id_categoria IN ($categoria_ids_string)";
}

if ($filtroCategoria != '' && empty($categoria_ids_string)) { // Fallback - should not be needed with corrected logic
    $sql .= " AND P.id_categoria = '$filtroCategoria'";
}

if ($pesquisa != '') {
    $sql .= " AND (P.titulo LIKE '$pesquisa' OR P.descricao LIKE '$pesquisa')";
}

// Contagem total para paginação - MANTIDO IGUAL
$resCount = $lig->query($sql);
$nr = $resCount->num_rows;
$qp = ceil($nr / $tp);

// Aplicar paginação - MANTIDO IGUAL
$sql .= " ORDER BY P.data_add DESC LIMIT $ini, $tp";
$produtos = $lig->query($sql);
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

<div class="container mt-5">
    <div class="row">
        <?php
        if ($produtos->num_rows > 0): // CHECK IF PRODUCTS WERE FOUND
        while ($produto = $produtos->fetch_assoc()):
        ?>
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
                    <div class="card-body" data-description="<?php echo htmlspecialchars($produto['descricao']); ?>">
    <h5 class="card-title"><?php echo htmlspecialchars(mb_strimwidth($produto['titulo'], 0, 20, '...')); ?></h5>

	<p class="card-text">
		<strong>Tamanho:</strong> <?php echo htmlspecialchars($produto['size']); ?><br>
        <strong>Preço:</strong> €<?php echo htmlspecialchars($produto['preco']); ?><br>
        <strong>Categoria:</strong> <?php echo htmlspecialchars(mb_strimwidth($produto['nome_categoria'], 0, 15, '...')); ?>
    </p>
                        <button class="btn btn-primary" onclick="window.location.href='index.php?cmd=produto_detalhes&id_prod=<?php echo $produto['id_prod']; ?>'">Ver Detalhes</button>
                    </div>
                </div>
            </div>
        <?php endwhile;
        else: // NO PRODUCTS FOUND MESSAGE ?>
        <div class="col-12 text-center mt-5">
            <p class="lead">Não foram encontrados produtos nesta categoria.</p>
        </div>
        <?php endif; // END OF PRODUCTS FOUND CHECK ?>
    </div>
</div>

<nav>
    <ul class="pagination justify-content-center mt-4">
        <?php for ($i = 1; $i <= $qp; $i++): ?>
            <li class="page-item <?php echo ($i == $np) ? 'active' : ''; ?>">
                <a class="page-link" href="index.php?cmd=ver_mais&pag=<?php echo $i; ?>&filtroCategoria=<?php echo $filtroCategoria; ?>&pesquisa=<?php echo urlencode($_REQUEST['pesquisa'] ?? ''); ?>&<?php echo isset($_GET['categoria_principal']) ? 'categoria_principal=' . $_GET['categoria_principal'] : (isset($_GET['cod']) ? 'cod=' . $_GET['cod'] : ''); ?>">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>