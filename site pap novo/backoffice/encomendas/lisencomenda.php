<?php
// lisencomenda.php

// Definir o número de resultados por página
$tp = 3; // Encomendas por página
if (isset($_REQUEST['pag'])) {
    $np = $_REQUEST['pag'];
} else {
    $np = 1;
}
$ini = ($np - 1) * $tp;

// Filtro de pesquisa
$pesquisa = isset($_REQUEST['pesquisa']) ? '%' . $_REQUEST['pesquisa'] . '%' : '';

// Base da query com join para obter o título do produto
$sql = "SELECT e.*, p.titulo AS produto 
        FROM encomendas e
        LEFT JOIN Produtos p ON e.id_prod = p.id_prod
        WHERE 1=1";

if ($pesquisa != '') {
    $sql .= " AND (e.email_comprador LIKE '$pesquisa' OR e.email_vendedor LIKE '$pesquisa' OR e.estado LIKE '$pesquisa')";
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
<div class="container">
    <h1 align="center" class="text-center mt-5 mb-3">Listagem de Encomendas</h1>
    <br><br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Encomenda</th>
                <th>Produto</th>
                <th>Comprador (Email)</th>
                <th>Vendedor (Email)</th>
                <th>Preço</th>
                <th>Estado</th>
                <th>Data Compra</th>
                <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] != 3) { ?>
                    <th>Ações</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php while ($lin = $res->fetch_array()) { ?>
                <tr>
                    <td><?php echo $lin['id_encomenda']; ?></td>
                    <td><?php echo $lin['produto'] ?? 'Sem Produto'; ?></td>
                    <td><?php echo $lin['email_comprador']; ?></td>
                    <td><?php echo $lin['email_vendedor']; ?></td>
                    <td><?php echo $lin['preco']; ?> €</td>
                    <td><?php echo $lin['estado']; ?></td>
                    <td><?php echo $lin['data_compra']; ?></td>
                    <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] != 3) { ?>
                        <td>
                            <a href="index.php?cmd=edencomenda&id_encomenda=<?php echo urlencode($lin['id_encomenda']); ?>" class="btn btn-warning btn-sm">Alterar</a>
                            <a href="index.php?cmd=delencomenda&id_encomenda=<?php echo urlencode($lin['id_encomenda']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem a certeza que deseja eliminar esta encomenda?');">Apagar</a>
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
            echo "<a href='index.php?cmd=lisencomenda&pag=$i&pesquisa=" . urlencode($currentPesquisa) . "' style='padding: 10px 15px; margin: 0 5px; background-color: #007BFF; color: white; border-radius: 5px; text-decoration: none;'>$i</a>";
        } else {
            echo "<a href='index.php?cmd=lisencomenda&pag=$i&pesquisa=" . urlencode($currentPesquisa) . "' style='padding: 10px 15px; margin: 0 5px; background-color: #f1f1f1; color: #007BFF; border: 1px solid #007BFF; border-radius: 5px; text-decoration: none;'>$i</a>";
        }
    }
    ?>
</p>
