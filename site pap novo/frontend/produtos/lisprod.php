<?php 
// Definir o número de resultados por página
$tp = 3; // Produtos por página
if (isset($_REQUEST['pag'])) $np = $_REQUEST['pag']; else $np = 1;
$ini = ($np - 1) * $tp;

// Inicializar filtros
$filtroCategoria = isset($_REQUEST['filtroCategoria']) ? $_REQUEST['filtroCategoria'] : '';
$pesquisa = isset($_REQUEST['pesquisa']) ? '%' . $_REQUEST['pesquisa'] . '%' : '';

// Base da query
$sql = "SELECT p.*, c.nome_categoria 
        FROM Produtos p 
        LEFT JOIN categorias c ON p.id_categoria = c.id_categoria 
        WHERE 1=1";


// Aplicar filtros
if ($filtroCategoria != '') {
    $sql .= " AND c.id_categoria = '$filtroCategoria'";
}
if ($pesquisa != '') {
    $sql .= " AND (p.titulo LIKE '$pesquisa' OR p.email LIKE '$pesquisa')";
}

// Obter o número total de resultados
$res = $lig->query($sql);
$nr = $res->num_rows;
$qp = ceil($nr / $tp);

// Adicionar limite para paginação
$sql .= " LIMIT $ini, $tp";

// Executar a query final
$res = $lig->query($sql);
?>

<div class="container" align="center">
    <form class="form-inline" align="center" method="POST" action="index.php?cmd=lisprod" style="margin-top: 20px; display: flex; justify-content: center; gap: 20px; align-items: center;">
        <div class="form-group">
            <label for="filtroCategoria">Filtrar por Categoria:</label>
            <select class="form-control" name="filtroCategoria" style="width: 200px;">
                <option value="">Todas</option>
                <?php
                // Obter categorias do banco de dados
                $sqlCategories = "SELECT * FROM categorias";
                $resCategories = $lig->query($sqlCategories);
                while ($row = $resCategories->fetch_array()) {
                    echo "<option value='" . $row['id_categoria'] . "' " . ($filtroCategoria == $row['id_categoria'] ? "selected" : "") . ">" . $row['nome_categoria'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="pesquisa">Pesquisar:</label>
            <input type="text" class="form-control" name="pesquisa" value="<?php echo isset($_REQUEST['pesquisa']) ? $_REQUEST['pesquisa'] : ''; ?>" style="width: 220px;">
        </div>

        <button type="submit" class="btn btn-primary" style="margin-top: 25px;">Filtrar</button>
    </form>
</div>

<div class="container">
    <h1 align="center" class="text-center mt-5 mb-3">Listagem de Produtos</h1>
    <br><br>      
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Tamanho</th>
                <th>Preço</th>
                <th>Foto</th>
                <th>Vendedor (Email)</th>
                <th>Categoria</th>
                <?php if (isset($_SESSION['tipo_utilizador']) && $_SESSION['tipo_utilizador'] != 3) { ?>
                    <th>Ações</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php while ($lin = $res->fetch_array()) { ?>
                <tr>
                    <td><?php echo $lin['titulo']; ?></td>
                    <td><?php echo $lin['size']; ?></td>
                    <td><?php echo $lin['preco']; ?> €</td>
                    <td>
                        <img src='<?php echo isset($lin['foto_prod']) ? $lin['foto_prod'] : 'caminho/para/imagem/default.jpg'; ?>' height='50' width='50' style="cursor:pointer;" onclick="openModal('<?php echo isset($lin['foto_prod']) ? $lin['foto_prod'] : 'caminho/para/imagem/default.jpg'; ?>')">
                    </td>
                    <td><?php echo $lin['email']; ?></td>
                    <td><?php echo $lin['nome_categoria'] ?? 'Sem Categoria'; ?></td>
                    <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] != '3') { ?>
                        <td>
                            <a href="index.php?cmd=edprod&id_prod=<?php echo urlencode($lin['id_prod']); ?>" class="btn btn-warning btn-sm">Alterar</a>
                            <a href="index.php?cmd=delprod&id_prod=<?php echo urlencode($lin['id_prod']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem a certeza que deseja eliminar este produto?');">Apagar</a>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Paginação -->
<p align="center" style="margin-top: 20px;">
    <?php
    for ($i = 1; $i <= $qp; $i++) {
        $currentPesquisa = isset($_REQUEST['pesquisa']) ? $_REQUEST['pesquisa'] : '';
        if ($i == $np) {
            echo "<a href='index.php?cmd=lisprod&pag=$i&filtroCategoria=$filtroCategoria&pesquisa=" . urlencode($currentPesquisa) . "' style='padding: 10px 15px; margin: 0 5px; background-color: #007BFF; color: white; border-radius: 5px; text-decoration: none;'>$i</a>";
        } else {
            echo "<a href='index.php?cmd=lisprod&pag=$i&filtroCategoria=$filtroCategoria&pesquisa=" . urlencode($currentPesquisa) . "' style='padding: 10px 15px; margin: 0 5px; background-color: #f1f1f1; color: #007BFF; border: 1px solid #007BFF; border-radius: 5px; text-decoration: none;'>$i</a>";
        }
    }
    ?>
</p>
