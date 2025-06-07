<?php
// Ajuste da query SQL
$sql = "SELECT G.*, TG.nome_tipo 
        FROM gestor G 
        JOIN tipo_gestor TG ON TG.id_tipog = G.id_tipog;";
$res = $lig->query($sql);
?>

<div class="container">
    <h1 align="center" style="margin-top: 50px;">Listagem de Gestores</h1> <br>    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Tipo Gestor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($lin = $res->fetch_array()) { ?>
            <tr>
                <td><?php echo $lin['id']; ?></td>
                <td><?php echo $lin['username']; ?></td>
                <td><?php echo $lin['nome_tipo']; ?></td>
                <td>
                    <a href="index.php?cmd=delges&id=<?php echo $lin['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem a certeza que deseja apagar este gestor?');">Apagar</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
