<?php
$email = $_SESSION['email']; // Assumindo que o email do utilizador está guardado na sessão

// Consulta para listar os produtos no carrinho
$sql = "SELECT c.id_prod, p.nome_prod, c.quantidade, c.data_adicao 
        FROM carrinho c 
        JOIN produtos p ON c.id_prod = p.id_prod 
        WHERE c.email = '$email'";
$res = $lig->query($sql);
?>

<div class="container">
    <h1 class="text-center mt-5 mb-3">Carrinho de Compras</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Data de Adição</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($lin = $res->fetch_array()) { ?>
                <tr>
                    <td><?php echo $lin['nome_prod']; ?></td>
                    <td><?php echo $lin['quantidade']; ?></td>
                    <td><?php echo $lin['data_adicao']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
