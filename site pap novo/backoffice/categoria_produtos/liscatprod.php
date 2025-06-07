<?php
// Conexão com a base de dados
include './includes/ligamysql.php';

// Selecionar todas as categorias de produtos com informações dos produtos e categorias
$sql = "SELECT cp.id, cp.id_prod, p.titulo AS nome_produto, c.nome_categoria 
        FROM categoria_produtos cp 
        JOIN Produtos p ON cp.id_prod = p.id_prod 
        JOIN categorias c ON c.id_categoria = cp.id"; 

$res = $lig->query($sql);
?>

<div class="container">
    <h1 align="center" class="text-center mt-5 mb-3">Listagem de Categorias de Produtos</h1> <br><br>      
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Categoria</th>
                <th>Nome da Categoria</th>
                <th>ID Produto</th>
                <th>Nome do Produto</th>
                <?php if ($_SESSION['tipo'] == 1 || $_SESSION['tipo'] == 2) { ?> <!-- Apenas Admin (1) e Gestor (2) veem o botão -->
                    <th>Ações</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php while ($lin = $res->fetch_array()) { ?>
                <tr>
                    <td><?php echo $lin['id']; ?></td>
                    <td><?php echo htmlspecialchars($lin['nome_categoria']); ?></td>
                    <td><?php echo $lin['id_prod']; ?></td>
                    <td><?php echo htmlspecialchars($lin['nome_produto']); ?></td>
                    <?php if ($_SESSION['tipo'] == 1 || $_SESSION['tipo'] == 2) { ?> <!-- Apenas Admin (1) e Gestor (2) veem o botão -->
                        <td>
                            <a href="index.php?cmd=delcatprod&id=<?php echo $lin['id']; ?>&id_produto=<?php echo $lin['id_prod']; ?>" class="btn btn-danger" onclick="return confirm('Tem a certeza que deseja eliminar este produto da categoria?');">Eliminar</a>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
