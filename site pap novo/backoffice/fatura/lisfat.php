<?php
// lisfatura.php

$tp = 3; // Faturas por página
if (isset($_REQUEST['pag'])) {
    $np = $_REQUEST['pag'];
} else {
    $np = 1;
}
$ini = ($np - 1) * $tp;

$pesquisa = isset($_REQUEST['pesquisa']) ? '%' . $_REQUEST['pesquisa'] . '%' : '';

$sql = "SELECT * FROM fatura WHERE 1=1";
if ($pesquisa != '') {
    $sql .= " AND (emailC LIKE '$pesquisa' OR Nome LIKE '$pesquisa')";
}

$res = $lig->query($sql);
$nr = $res->num_rows;
$qp = ceil($nr / $tp);

$sql .= " LIMIT $ini, $tp";
$res = $lig->query($sql);
?>
<div class="container">
    <h1 align="center" class="text-center mt-5 mb-3">Listagem de Faturas</h1>
    <br><br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Fatura</th>
                <th>Email Comprador</th>
                <th>Valor</th>
                <th>Data Fatura</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Morada</th>
                <th>CPostal</th>
                <th>NIF</th>
                <th>Email Vendedor</th> 
                <th>ID Encomenda</th>
                <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] != 3) { ?>
                    <th>Ações</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php while ($lin = $res->fetch_array()) { ?>
                <tr>
                    <td><?php echo $lin['id_fatura']; ?></td>
                    <td><?php echo $lin['emailC']; ?></td>
                    <td><?php echo $lin['valor']; ?> €</td>
                    <td><?php echo $lin['data_fatura']; ?></td>
                    <td><?php echo $lin['Nome']; ?></td>
                    <td><?php echo $lin['Telefone']; ?></td>
                    <td><?php echo $lin['Morada']; ?></td>
                    <td><?php echo $lin['CPostal']; ?></td>
                    <td><?php echo $lin['NIF']; ?></td>
                    <td><?php echo $lin['emailV']; ?></td>
                    <td><?php echo $lin['id_encomenda']; ?></td>
                    <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] != 3) { ?>
                        <td>
                            <a href="index.php?cmd=edfat&id_fatura=<?php echo urlencode($lin['id_fatura']); ?>" class="btn btn-warning btn-sm" >Editar</a>
                            <a href="index.php?cmd=delfat&id_fatura=<?php echo urlencode($lin['id_fatura']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem a certeza que deseja eliminar esta fatura?');">Apagar</a>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<p align="center" style="margin-top: 20px;">
    <?php
    for ($i = 1; $i <= $qp; $i++) {
        $currentPesquisa = isset($_REQUEST['pesquisa']) ? $_REQUEST['pesquisa'] : '';
        if ($i == $np) {
            echo "<a href='index.php?cmd=lisfat&pag=$i&pesquisa=" . urlencode($currentPesquisa) . "' style='padding: 10px 15px; margin: 0 5px; background-color: #007BFF; color: white; border-radius: 5px; text-decoration: none;'>$i</a>";
        } else {
            echo "<a href='index.php?cmd=lisfat&pag=$i&pesquisa=" . urlencode($currentPesquisa) . "' style='padding: 10px 15px; margin: 0 5px; background-color: #f1f1f1; color: #007BFF; border: 1px solid #007BFF; border-radius: 5px; text-decoration: none;'>$i</a>";
        }
    }
    ?>
</p>
