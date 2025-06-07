<?php
// Conexão com a base de dados
include './includes/ligamysql.php';

// Selecionar todas as categorias, incluindo o nome do pai
$sql = "SELECT c.cod_categoria, c.nome_categoria, p.nome_categoria AS nome_pai
        FROM categorias c
        LEFT JOIN categorias p ON c.pai = p.cod_categoria";
$res = $lig->query($sql);
?>

<div class="container">
    <h1 align="center" class="text-center mt-5 mb-3">Listagem de Categorias</h1> <br><br>      
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID da Categoria</th>
                <th>Nome da Categoria</th>
                <th>Categoria Pai</th>
                <?php if ($_SESSION['tipo'] != 3) { ?> <!-- Apenas mostra o cabeçalho de ações para Admin e Gestor -->
                    <th>Ações</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php while ($lin = $res->fetch_array()) { ?>
                <tr>
                    <td><?php echo $lin['cod_categoria']; ?></td>
                    <td><?php echo $lin['nome_categoria']; ?></td>
                    <td><?php echo $lin['nome_pai'] ? $lin['nome_pai'] : 'Nenhuma'; ?></td>
                    <?php if ($_SESSION['tipo'] != 3) { ?> <!-- Apenas mostra o botão de apagar para Admin e Gestor -->
                        <td>
                            <a href="index.php?cmd=delcat&cod_categoria=<?php echo urlencode($lin['cod_categoria']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem a certeza que deseja eliminar esta categoria?');">Apagar</a>
                        </td>
                    <?php } ?>
                </tr> 
            <?php } ?>
        </tbody>
    </table>
</div>
